@extends('layouts.erp')

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
                <li class="breadcrumb-item"><a href="{{route('branches.list')}}">الفروع</a></li>
                <li class="breadcrumb-item active">ملف فرع
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/branch.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $branchData->branch_name }} </span>
            </h4>
          <span>رقم الفرع:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $branchData->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('branches.view', $branchData->id) }}">استعراض الفرع</a>
            <a class="dropdown-item" href="{{ route('branches.edit', $branchData->id) }}">تعديل الفرع</a>
            @if($branchData->id != 1)
            <div class="dropdown-divider"></div>
            <form action="{{route('branches.delete',$branchData->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا الفرع نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف الفرع</button>
            </form>
            @endif
        </div>
    </div>
    <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التواصل مع الفرع</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            @if ( isset($branchData->branch_mobile))
        <a class="dropdown-item" href="tel:{{$branchData->branch_mobile}}">اتصال بالموبايل</a>
            @else
            <button class="dropdown-item" href="#">اتصال بالموبايل</button>
            @endif
            @if ( isset($branchData->branch_phone))
        <a class="dropdown-item" href="tel:{{$branchData->branch_phone}}">اتصال بالتليفون</a>
            @else
            <button class="dropdown-item" href="#">اتصال بالتليفون</button>
            @endif
            <button class="dropdown-item" disabled>ارسال SMS <small style="color: red">غير متاحة</small></button>
            @if ( isset($branchData->branch_email))
        <a class="dropdown-item" href="mailto:{{$branchData->branch_email}}"> ارسال ايميل</a>
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
                  <td>اسم الفرع:</td>
                  <td>{{ $branchData->branch_name }}</td>
                </tr>

                <tr>
                  <td>الموبايل:</td>
                  <td>{{ $branchData->branch_mobile }}</td>
                </tr>
                <tr>
                  <td>التليفون:</td>
                  <td>@if(isset($branchData->branch_phone))
                    {{ $branchData->branch_phone }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                <tr>
                   <td>الايميل:</td>
                   <td>@if(isset($branchData->branch_email))
                    {{ $branchData->branch_email }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>


                <tr>
                   <td>العنوان:</td>
                   <td> @if(isset($branchData->branch_address))
                    {{ $branchData->branch_address }}
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
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">{{ $safeBalance }} جنية</i><span>رصيد الخزنة</span></button>
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">{{$productsCount}}</i><span>عدد أصناف الفرع</span></button>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->
  <div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-content">
        <div class="card-body">

          <div class="col-12">
             {{-- <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> صنف جديد</a> --}}
              <h2 style="text-align: center">جرد الفرع (الأصناف الموجودة بالمخزن)</h2>
            <div class="table-responsive">
              <table class="table mb-0" id="productsSelling">
                <thead>
                  <tr>
                    <th>كود الصنف</th>
                    <th>اسم الصنف</th>
                    <th>الكمية المتاحة</th>
                    <th>عمليات</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($branchProducts as $key => $product)
                  <tr>
                    <td><div class="badge border-info info badge-border">
                        <a href="{{ route('products.view',$product->id) }}" target="_blank" style="color: #1e9ff2"><span>{{$product->product->product_id}}</span></a>
                    </div></td>
                    <td>{{$product->product[0]->product_name}}</td>
                    <td>{{$product->amount}}</td>
                    <td>
                        <a class="btn btn-secondary" href="{{route('products.transfer',$product->product_id)}}">تحويل كمية لفرع اخر</a>
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

    <div class="col-md-4">
    <div class="card">
      <div class="card-content">
        <div class="card-body">

          <div class="col-12">
             {{-- <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> صنف جديد</a> --}}
             <h2 style="text-align: center"> الأصناف المسموح ببيعها في هذا الفرع</h2>
            <div class="table-responsive">
              <table class="table mb-0" id="products">
                <thead>
                  <tr>
                    <th>كود الصنف</th>
                    <th>اسم الصنف</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($branchProductsSelling as $key => $product)
                  <tr>
                    <td><div class="badge border-info info badge-border">
                        <a href="{{ route('products.view',$product->id) }}" target="_blank" style="color: #1e9ff2"><span>{{$product->product[0]->product_code}}</span></a>
                    </div></td>
                    <td>{{$product->product[0]->product_name}}</td>

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
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script>
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
                messageTop: 'أصناف فرع {{ $branchData->branch_name }}',
                exportOptions: {
                    columns: [2,1,0 ]
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
                messageTop: 'أصناف فرع \n {{ $branchData->branch_name }}',
                exportOptions: {
                    columns: [2,1,0 ],
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'أصناف فرع {{ $branchData->branch_name }}',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            }
        ]
    });
$("#productsSelling").DataTable({
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'الأصناف المسموح ببيعها في فرع  {{ $branchData->branch_name }}',
                exportOptions: {
                    columns: [1,0 ]
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
                messageTop: 'الأصناف المسموح ببيعها في فرع \n {{ $branchData->branch_name }}',
                exportOptions: {
                    columns: [1,0 ],
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'الأصناف المسموح ببيعها في فرع {{ $branchData->branch_name }}',
                exportOptions: {
                    columns: [ 0, 1 ]
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
