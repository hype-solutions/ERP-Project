@extends('layouts.erp')
@section('title', 'ملف مورد '.$supplier->supplier_name)

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
<!-- END: Page CSS-->
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')

<div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- users view start -->
<section class="users-view">
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('suppliers.list')}}">الموردين</a></li>
                <li class="breadcrumb-item active">ملف مورد
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/supplier.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $supplier->supplier_name }} </span>
            </h4>
          <span>رقم المورد:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $supplier->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('suppliers.view', $supplier->id) }}">استعراض الملف</a>
            <a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}">تعديل الملف</a>
            <a class="dropdown-item" href="{{ route('purchasesorders.add') }}">أمر شراء جديد </a>
            <div class="dropdown-divider"></div>
            <form action="{{route('suppliers.delete',$supplier->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا المورد نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف المورد</button>
            </form>
        </div>
    </div>
    <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التواصل مع المورد</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            @if ( isset($supplier->supplier_mobile))
        <a class="dropdown-item" href="tel:{{$supplier->supplier_mobile}}">اتصال بالموبايل</a>
            @else
            <button class="dropdown-item" href="#">اتصال بالموبايل</button>
            @endif
            @if ( isset($supplier->supplier_phone))
        <a class="dropdown-item" href="tel:{{$supplier->supplier_phone}}">اتصال بالتليفون</a>
            @else
            <button class="dropdown-item" href="#">اتصال بالتليفون</button>
            @endif
            <button class="dropdown-item" disabled>ارسال SMS <small style="color: red">غير متاحة</small></button>
            @if ( isset($supplier->supplier_email))
        <a class="dropdown-item" href="mailto:{{$supplier->supplier_email}}"> ارسال ايميل</a>
            @else
            <button class="dropdown-item" href="#"> ارسال ايميل</button>
            @endif
        </div>
    </div>
    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        {{-- <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات الشراء: <span class="font-large-1 align-middle">125</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات عرض السعر: <span class="font-large-1 align-middle">534</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">إجمالي المبالغ من الفواتير: <span class="font-large-1 align-middle">256 جنية</span></h6>
            </div>
          </div> --}}
        <div class="row">
          <div class="col-12 col-md-4">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td>اسم المورد:</td>
                  <td>{{ $supplier->supplier_name }}</td>
                </tr>
                <tr>
                  <td>الشركة:</td>
                  <td>{{ $supplier->supplier_company }}</td>
                </tr>

                <tr>
                  <td>الموبايل:</td>
                  <td>{{ $supplier->supplier_mobile }}</td>
                </tr>
                <tr>
                  <td>التليفون:</td>
                  <td>@if(isset($supplier->supplier_phone))
                    {{ $supplier->supplier_phone }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                <tr>
                   <td>الايميل:</td>
                   <td>@if(isset($supplier->supplier_email))
                    {{ $supplier->supplier_email }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>

                <tr>
                    <td>السجل التجاري:</td>
                    <td>
                        @if(isset($supplier->supplier_commercial_registry))
                        {{ $supplier->supplier_commercial_registry }}
                        @else
                        <small style="font-style: italic;color:red;">غير مسجل</small>
                        @endif
                    </td>
                 </tr>
                 <tr>
                    <td>البطاقة الضريبية:</td>
                    <td>
                        @if(isset($supplier->supplier_tax_card))
                    {{ $supplier->supplier_tax_card }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif
                </td>
                 </tr>

                <tr>
                   <td>العنوان:</td>
                   <td> @if(isset($supplier->supplier_address))
                    {{ $supplier->supplier_address }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل </small>
                     @endif</td>
                </tr>
                <tr>
                    <td>الملاحظات:</td>
                    <td> @if(isset($supplier->supplier_notes))
                     {{ $supplier->supplier_notes }}
                     @else
                     <small style="font-style: italic;color:red;">غير مسجل </small>
                      @endif</td>
                 </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xl-6 col-lg-12 mb-1">
            <div class="form-group text-center">
                <!-- Floating Outline button with text -->
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">{{$countPurchases}}</i><span>عدد أوامر الشراء</span></button>
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">{{$sumPurchases}} ج.م</i><span>إجمالي المبالغ من الشراء</span></button>
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">{{$countProducts}}</i><span>عدد أصناف المورد</span></button>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->

  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            {{-- <h4 class="card-title">Tab with Underline</h4> --}}
          </div>
          <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs nav-top-border no-hover-bg mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" id="active-tab32" data-toggle="tab" href="#active32" aria-controls="active32" aria-expanded="true">أصنفاف المورد</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="link-tab32" data-toggle="tab" href="#link32" aria-controls="link32" aria-expanded="false">المبالغ المستحقة</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="link-tab35" data-toggle="tab" href="#link35" aria-controls="link35" aria-expanded="false">أوامر الشراء</a>
                    </li>
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="active32" aria-labelledby="active-tab32" aria-expanded="true">
                      <div class="table-responsive">
                        <table class="table mb-0"  id="products">
                            <thead>
                                <tr>
                                    <th> الصنف</th>
                                    <th>إجمالي الكمية الموردة</th>
                                    <th>عدد مرات التوريد</th>
                                    <th>أقل سعر</th>
                                    <th>أعلى سعر</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierProducts as $item)
                                <tr>
                                <td>{{$item->product->product_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->counttimes}}</td>
                                <td><span style="color : rgb(35, 145, 45)">أقل سعر: </span>{{$item->minprice}} ج.م</td>
                                <td><span style="color: crimson;white-space: pre-line">أعلى سعر: </span>{{$item->maxprice}} ج.م</td>
                            </tr>
                              @endforeach
                             </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="link32" role="tabpanel" aria-labelledby="link-tab32" aria-expanded="false">
                        <div class="table-responsive">
                            <table class="table mb-0" id="due">
                                <thead>
                                  <tr>
                                    <th>رقم أمر الشراء</th>
                                    <th>تاريخ الإستحقاق</th>
                                    <th>تم الدفع؟</th>
                                    <th>الإجمالي</th>
                                    <th>التحكم</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supplierInstallments as $item)
                                  <tr>
                                    <td><div class="badge border-info info badge-border">
                                        <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$item->purchase_id}}</span></a>
                                    <i class="la la-barcode font-medium-2"></i>
                                    </div></td>
                                    <td>{{$item->date}}</td>
                                    <td>
                                        @if($item->paid == 'Yes')
                                        <span class="text-success">نعم</span>
                                        @else
                                        <span class="text-danger">لا</span>
                                        @endif
                                    </td>
                                    <td>{{$item->amount}} ج.م</td>
                                    <td>
                                        @if($item->paid == 'Yes')
                                        <button class="btn btn-primary">استعراض أمر الشراء</button>
                                        <button class="btn btn-info">استعراض فاتورة التسديد</button>
                                        <button class="btn btn-dark">طباعة فاتورة التسديد</button>
                                        @else
                                        <button class="btn btn-primary">استعراض أمر الشراء</button>
                                        <button class="btn btn-success">دفع الان</button>
                                        <button class="btn btn-warning">ارسال تذكير للمورد</button>
                                        @endif
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="tab-pane" id="link35" role="tabpanel" aria-labelledby="link-tab35" aria-expanded="false">
                        <div class="table-responsive">
                            <table class="table mb-0" id="purchases_orders">
                                <thead>
                                  <tr>
                                    <th>رقم الأمر</th>
                                    <th>التاريخ</th>
                                    <th>تم الدفع؟</th>
                                    <th>تم الإستلام؟</th>
                                    <th>الإجمالي</th>
                                    <th>التحكم</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchases as $purchase)
                                  <tr>
                                    <td>
                                        <div class="badge border-warning warning badge-border">
                                          <a href="#" target="_blank" style="color: #ff9149"><span>{{$purchase->id}}</span></a>
                                      <i class="la la-barcode font-medium-2"></i>
                                      </div>
                                    </td>
                                    <td>{{$purchase->purchase_date}}</td>
                                    <td>@if($purchase->already_paid > 0)
                                        <div class="badge badge-success">
                                          <i class="la la-money font-medium-2"></i>
                                              <span>مدفوع</span>
                                          </div>
                                        @else
                                        <div class="badge badge-danger">
                                          <i class="la la-money font-medium-2"></i>
                                              <span>لم يدفع</span>
                                          </div>
                                        @endif</td>
                                    <td>@if($purchase->already_delivered > 0)
                                        <div class="badge badge-success">
                                          <i class="la la-truck font-medium-2"></i>
                                          <span>تم الإستلام</span>
                                      </div>
                                        @else
                                        <div class="badge badge-danger">
                                          <i class="la la-truck font-medium-2"></i>
                                          <span>لم يستلم</span>
                                      </div>
                                        @endif</td>
                                    <td>{{$purchase->purchase_total}} ج.م</td>
                                    <td>
                                        <button class="btn btn-success">استعراض أمر الشراء</button>
                                        <button class="btn btn-dark">طباعة أمر الشراء</button>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
            </div>
          </div>
      </div>
    </div>
  </div>









  <!-- users view card details ends -->

</section>
<!-- users view ends -->
        </div>
      </div>



@include('common.footer')
@endsection


@section('pageJs')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.print.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-print.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/jszip.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/pdfmake.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/vfs_fonts.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script><!-- END: Page Vendor JS-->
<script>

$("#products").DataTable({
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'أصناف المورد {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
    // customize: function(doc) {
    //    console.dir(doc)
    //    doc.content[2].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
    //    doc.content[2].margin = [ 0, 0, 0, 0 ] //left, top, right, bottom
    // },
                text: 'حفظ كملف PDF',
                messageTop: 'أصناف المورد \n {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [4,3,2,1,0 ],
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'أصناف المورد {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4 ]
                }
            }
        ]
    });
$("#due").DataTable({
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'المبالغ المستحقة للمورد {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
    // customize: function(doc) {
    //    console.dir(doc)
    //    doc.content[2].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
    //    doc.content[2].margin = [ 0, 0, 0, 0 ] //left, top, right, bottom
    // },
                text: 'حفظ كملف PDF',
                messageTop: 'المبالغ المستحقة للمورد \n {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [3,2,1,0 ],
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'المبالغ المستحقة للمورد {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }
        ]
    });
$("#purchases_orders").DataTable({
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'أوامر شراء المورد {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
    // customize: function(doc) {
    //    console.dir(doc)
    //    doc.content[2].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
    //    doc.content[2].margin = [ 0, 0, 0, 0 ] //left, top, right, bottom
    // },
                text: 'حفظ كملف PDF',
                messageTop: 'أوامر شراء المورد \n {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [3,2,1,0 ],
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'أوامر شراء المورد {{ $supplier->supplier_name }}',
                exportOptions: {
                    columns: [ 0, 1, 2,3 ]
                }
            }
        ]
    });
</script>



<!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script> --}}
<!-- END: Page JS-->
@endsection
