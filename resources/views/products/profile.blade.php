@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
<!-- END: Vendor CSS-->
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
                <li class="breadcrumb-item"><a href="{{route('products.list')}}">المنتجات</a></li>
                <li class="breadcrumb-item active">ملف منتج
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/product.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $product->product_name }} </span>
            </h4>
          <span>رقم المنتج:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $product->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-2 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم في المنتج</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('products.view', $product->id) }}">استعراض المنتج</a>
            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">تعديل المنتج</a>
            <a class="dropdown-item" href="#">طباعه BARCODE</a>
            <div class="dropdown-divider"></div>
            <form action="{{route('products.delete',$product->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف المنتج</button>
            </form>
        </div>
    </div>
    <div class="btn-group mr-1 mb-1"  style="width: 100%;">
        <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التحكم في المخزون</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            {{-- <a class="dropdown-item" href="{{route('products.addQty',$product->id)}}">أضف كمية يدويا</a> --}}
            <a class="dropdown-item" href="{{route('purchasesorders.add')}}">أمر شراء جديد</a>
            <a class="dropdown-item" href="{{route('products.transfer',$product->id)}}">تحويل كميات بين الفروع</a>

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
              <h6 class="text-primary mb-0">إجمالي المبالغ من الفواتير: <span class="font-large-1 align-middle">256 ج.م</span></h6>
            </div>
          </div> --}}
        <div class="row">
          <div class="col-12 col-md-4">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td>اسم المنتج:</td>
                  <td>{{ $product->product_name }}</td>
                </tr>

                <tr>
                  <td>كود المنتج:</td>
                  <td>@if(isset($product->product_code))
                    {{ $product->product_code }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                <tr>
                    <td> الوصف:</td>
                    <td>@if(isset($product->product_code))
                      {{ $product->product_code }}
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                <tr>
                    <td> الفئة: </td>
                    <td>@if(isset($product->product_category))
                      <a href="#">{{ $product->cat->cat_name }}</a>
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>

                  <tr>
                    <td>  سعر البيع:</td>
                    <td>@if(isset($product->product_price))
                      {{ $product->product_price }}
                      ج.م
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                  <tr>
                    <td> كمية المخزون:</td>
                    <td>
                      {{ $product->product_total_in - $product->product_total_out }}
                      </td>
                  </tr>
                  <tr>
                    <td> الماركة:</td>
                    <td>@if(isset($product->product_brand))
                      {{ $product->product_brand }}
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                  <tr>
                    <td> تتبع المخزون:</td>
                    <td>@if(($product->product_track_stock == 1))
                      نعم (تنبيه عند الوصل الى {{$product->product_low_stock_thershold}} قطع)
                      @else
                      لا
                      @endif</td>
                  </tr>




                <tr>
                    <td>الملاحظات الداخليه:</td>
                    <td> @if(isset($product->product_notes))
                     {{ $product->product_notes }}
                     @else
                     <small style="font-style: italic;color:red;">غير مسجل </small>
                      @endif</td>
                 </tr>
                 <tr>


                     <td>الفروع المسموح بالبيع فيها</td>
                     <td>
                         @foreach ($allowedBranches as $branch)
                         {{$branch->branch->branch_name}}<br/>
                         @endforeach
                        </td>
                 </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xl-6 col-lg-12 mb-1">
            <div class="form-group text-center">
                <!-- Floating Outline button with text -->
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">{{$productCost+0}} ج.م</i><span>متوسط سعر التكلفة</span></button>
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">{{$product->product_total_out }}</i><span>إجمالي القطع المباعة</span></button>
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">{{ $product->product_total_in - $product->product_total_out }}</i><span>كمية المخزون</span></button>
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
                  <a class="nav-link active" id="active-tab32" data-toggle="tab" href="#active32" aria-controls="active32" aria-expanded="true">رصيد الفروع</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="link-tab32" data-toggle="tab" href="#link32" aria-controls="link32" aria-expanded="false">الموردين</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="link-tab33" data-toggle="tab" href="#link33" aria-controls="link33" aria-expanded="false">التحويلات بين الفروع</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" id="link-tab34" data-toggle="tab" href="#link34" aria-controls="link34" aria-expanded="false">الكميات المضافة يدويا</a>
                  </li> --}}
                  <li class="nav-item">
                    <a class="nav-link" id="link-tab35" data-toggle="tab" href="#link35" aria-controls="link35" aria-expanded="false">أوامر الشراء</a>
                  </li>
                       <li class="nav-item">
                    <a class="nav-link" id="link-tab36" data-toggle="tab" href="#link36" aria-controls="link36" aria-expanded="false">فواتير البيع</a>
                  </li>
              </ul>
              <div class="tab-content px-1 pt-1">
                <div role="tabpanel" class="tab-pane active" id="active32" aria-labelledby="active-tab32" aria-expanded="true">
                    <div class="table-responsive">
                    <table class="table mb-0" id="branches_qty">
                        <thead>
                          <tr>
                            <th>كود الفرع</th>
                            <th> الفرع</th>
                            <th>الكمية المتاحة</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $key => $branch)
                            <tr>
                                <td><div class="badge border-info info badge-border">
                                    <a href="{{ route('branches.view',$branch->branch->id) }}" target="_blank" style="color: #1e9ff2"><span>{{$branch->branch->id}}</span></a>
                                </div></td>
                            <td><a href="{{ route('branches.view',$branch->branch->id) }}" target="_blank">{{$branch->branch->branch_name}}</a></td>
                            <td>{{$branch->amount}} وحدة</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
                <div class="tab-pane" id="link32" role="tabpanel" aria-labelledby="link-tab32" aria-expanded="false">
                    <div class="table-responsive">
                        <table class="table mb-0"  id="product_suppliers">
                            <thead>
                                <tr>
                                    <th> كود المورد</th>
                                    <th> اسم المورد</th>
                                    <th>إجمالي الكمية الموردة</th>
                                    <th>عدد مرات التوريد</th>
                                    <th>أقل سعر</th>
                                    <th>أعلى سعر</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierProducts as $item)
                                <tr>
                                    <td><div class="badge border-info info badge-border">
                                        <a href="{{ route('suppliers.view',$item->supplier->id) }}" target="_blank" style="color: #1e9ff2"><span>{{$item->supplier->id}}</span></a>
                                    </div></td>
                                <td><a href="{{ route('suppliers.view',$item->supplier->id) }}" target="_blank">{{$item->supplier->supplier_name}}</a></td>
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
                <div class="tab-pane" id="link33" role="tabpanel" aria-labelledby="link-tab33" aria-expanded="false">
                    <div class="table-responsive">
                        <table class="table mb-0" id="qty_transfers">
                            <thead>
                              <tr>
                                  {{-- <th>م#</th> --}}
                                <th>رقم العملية</th>
                                <th>التاريخ</th>
                                <th>من</th>
                                <th>الى</th>
                                <th>الكمية</th>
                                <th>الصلاحيات</th>
                                <th>الملاحظات</th>
                                <th>التحكم</th>
                              </tr>
                            </thead>
                            <tbody>
                          @if(isset($productransfers))
                              @foreach ($productransfers as $key => $transfer)
                            <tr>
                            {{-- <td>{{++$key}}</td> --}}
                              <td><div class="badge border-info info badge-border">
                                  <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$transfer->id}}</span></a>
                              </div>
                            </td>
                              <td>{{$transfer->transfer_datetime}}
                            </td>
                              <td>
                                  @if(isset($transfer->branchFrom))

                                    <div class="badge badge-success">
                                        <i class="la la-flag font-medium-2"></i>
                                            <span>{{$transfer->branchFrom->branch_name}}</span>
                                        </div>

                                  @else
                                  <div class="badge badge-danger">
                                    <i class="la la-trash font-medium-2"></i>
                                    <span>{{str_replace('عملية تحويل كميات من فرع الى أخر بسبب حذف فرع, اسم الفرع قبل الحذف ','',$transfer->transfer_notes)}}</span>
                                  </div>
                                    <span style="color: red">(فرع محذوف)</span>
                                  @endif
                                    <hr>
                                      المخزون قبل: {{$transfer->qty_before_transfer_from}}
                                      <br>
                                      المخزون بعد: {{$transfer->qty_after_transfer_from}}
                                </td>
                              <td>
                                @if(isset($transfer->branchTo))

                                    <div class="badge badge-warning">
                                        <i class="la la-arrow-left font-medium-2"></i>
                                            <span>{{$transfer->branchTo->branch_name}}</span>
                                        </div>

                                @else
                                <div class="badge badge-danger">
                                    <i class="la la-trash font-medium-2"></i>
                                        <span>{{str_replace('عملية تحويل كميات من فرع الى أخر بسبب حذف فرع, اسم الفرع قبل الحذف ','',$transfer->transfer_notes)}}</span>
                                    </div>
                                    <span style="color: red">(فرع فرع محذوف)</span>
                                                 @endif
                                <hr>
                                      المخزون قبل: {{$transfer->qty_before_transfer_to}}
                                      <br>
                                      المخزون بعد: {{$transfer->qty_after_transfer_to}}
                            </td>
                              <td>{{$transfer->transfer_qty}}</td>
                              <td>
                                قام بالتحويل
                                <div class="badge border-primary primary badge-border">
                                    <i class="la la-user font-medium-2"></i>
                                        <span>{{$transfer->user->username}}</span>
                                    </div>


                                  <br>
                                صرح بالتحويل
                                <div class="badge border-success success badge-square badge-border">
                                    <i class="la la-user font-medium-2"></i>
                                        <span>{{$transfer->user->username}}</span>
                                    </div>
                              </td>
                              <td>
                                {{$transfer->transfer_notes}}
                              </td>
                              <td>
                                <button class="btn btn-dark">طباعة</button>
                            </td>
                            </tr>
                            @endforeach
                          @endif
                          </tbody>
                          </table>
                    </div>
                </div>
                {{-- <div class="tab-pane" id="link34" role="tabpanel" aria-labelledby="link-tab34" aria-expanded="false">
                    <div class="table-responsive">
                        <table class="table mb-0" id="manual_add">
                            <thead>
                              <tr>
                                <th> رقم العملية</th>
                                <th> التاريخ</th>
                                <th> الكمية</th>
                                <th> الفرع</th>
                                <th> سعر الشراء</th>
                                <th> الصلاحيات</th>
                                <th> الملاحظات</th>
                                <th> التحكم</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($productManual as $key => $add)
                                <tr>
                                    <td><div class="badge border-info info badge-border">
                                        <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$add->id}}</span></a>
                                    </div>
                                  </td><td>
                                    {{$add->qty_datetime}}
                                  </td>
                                <td>{{$add->qty}}</td>
                                <td>

                                    <div class="badge badge-success">
                                        <i class="la la-flag font-medium-2"></i>
                                            <span>{{$add->branch->branch_name}}</span>
                                        </div>
                                    <br>
                                    المخزون قبل: {{$add->qty_before_add}}
                                    <br>
                                    المخزون بعد: {{$add->qty_after_add}}
                                </td>
                                <td>{{$add->qty_price}} ج.م</td>
                                <td>
                                    قام بالإضافة
                                    <div class="badge border-primary primary badge-border">
                                        <i class="la la-user font-medium-2"></i>
                                            <span>{{$add->user->username}}</span>
                                        </div>


                                      <br>
                                    صرح بالإضافة
                                    <div class="badge border-success success badge-square badge-border">
                                        <i class="la la-user font-medium-2"></i>
                                            <span>{{$add->user->username}}</span>
                                        </div>
                                  </td>
                                <td>{{$add->qty_notes}}</td>
                                <td>
                                  <button class="btn btn-dark">طباعة</button>
                              </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div> --}}
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
                                @foreach($productPurchasesOrders as $purchase)
                              <tr>
                                <td>
                                    <div class="badge border-warning warning badge-border">
                                      <a href="#" target="_blank" style="color: #ff9149"><span>{{$purchase->purchase->id}}</span></a>
                                  <i class="la la-barcode font-medium-2"></i>
                                  </div>
                                </td>
                                <td>{{$purchase->purchase->purchase_date}}</td>
                                <td>@if($purchase->purchase->already_paid > 0)
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
                                <td>@if($purchase->purchase->already_delivered > 0)
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
                                <td>{{$purchase->purchase->purchase_total}} ج.م</td>
                                <td>
                                    <a href="{{route('purchasesorders.view',$purchase->purchase->id)}}" class="btn btn-success">استعراض أمر الشراء</a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="tab-pane" id="link36" role="tabpanel" aria-labelledby="link-tab36" aria-expanded="false">
                    <div class="table-responsive">
                        <table class="table mb-0" id="reciepts">
                            <thead>
                              <tr>
                                <th>رقم الفاتورة</th>
                                <th>التاريخ</th>
                                <th>الإجمالي</th>
                                <th>التحكم</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($productInvoices as $item)
                              <tr>
                                <td><div class="badge border-info info badge-border">
                                    <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$item->invoice_id}}</span></a>
                                <i class="la la-barcode font-medium-2"></i>
                                </div></td>
                                <td>{{$item->invoice->invoice_date}}</td>
                                <td>{{$item->invoice->invoice_total}} ج.م</td>
                                <td>
                                    <a href="{{route('invoices.view',$item->invoice_id)}}" class="btn btn-success">استعراض الفاتورة</a>
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

    $("#branches_qty").DataTable( {
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'رصيد الفروع للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [2,1,0 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'رصيد الفروع للصنف: \n {{ $product->product_name }}',
                    exportOptions: {
                        columns: [2,1,0 ],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'رصيد الفروع للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [ 0, 1, 2 ]
                    }
                }
            ]
        });
        $("#product_suppliers").DataTable( {
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'موردين الصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [5,4,3,2,1,0 ],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'موردين الصنف: \n {{ $product->product_name }}',
                    exportOptions: {
                        columns: [5,4,3,2,1,0 ],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'موردين الصنف:  {{ $product->product_name }}',
                    exportOptions: {
                        columns: [ 0, 1, 2,3,4,5 ]
                    }
                }
            ]
        });
        $("#qty_transfers").DataTable( {
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'التحويلات بين الفروع للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [6,5,4,3,2,1,0 ],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'التحويلات بين الفروع للصنف: \n {{ $product->product_name }}',
                    exportOptions: {
                        columns: [6,5,4,3,2,1,0 ],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'التحويلات بين الفروع للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [ 0, 1, 2,3,4,5,6 ]
                    }
                }
            ]
        });
        $("#manual_add").DataTable( {
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'الكميات المضافة يدويا للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [6,5,4,3,2,1,0 ],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'الكميات المضافة يدويا للصنف: \n {{ $product->product_name }}',
                    exportOptions: {
                        columns: [6,5,4,3,2,1,0 ],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'الكميات المضافة يدويا للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [ 0, 1, 2,3,4,5,6 ]
                    }
                }
            ]
        });
        $("#purchases_orders").DataTable( {
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'أوامر الشراء للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [4,3,2,1,0 ],
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'أوامر الشراء للصنف: \n {{ $product->product_name }}',
                    exportOptions: {
                        columns: [4,3,2,1,0 ],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'أوامر الشراء للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                }
            ]
        });
        $("#reciepts").DataTable( {
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'فواتير البيع للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [2,1,0 ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'فواتير البيع للصنف: \n {{ $product->product_name }}',
                    exportOptions: {
                        columns: [2,1,0 ],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'فواتير البيع للصنف: {{ $product->product_name }}',
                    exportOptions: {
                        columns: [ 0, 1, 2 ]
                    }
                }
            ]
        });




</script>



<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script> --}}
<!-- END: Page JS-->
@endsection
