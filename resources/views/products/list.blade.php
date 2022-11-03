@extends('layouts.erp')
@section('title', 'قائمة المنتجات')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

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
        <div class="content-header-left col-md-6 col-12 mb-2">
            @if($catTitle)
            <h3 class="content-header-title mb-0">قائمة المنتجات - الفئة:  {{$catTitle}}</h3>
            @else
            <h3 class="content-header-title mb-0">قائمة المنتجات</h3>
            @endif
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('products.list')}}">المنتجات</a></li>
                <li class="breadcrumb-item active">استعراض
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12 mb-1">
          <div class="btn-group">
          <a href="{{route('products.add')}}" class="btn btn-outline-success block btn-lg" >
                إضافه منتج جديد
            </a>
            <a href="{{route('categories.list')}}" class="btn btn-outline-primary block btn-lg" >
                فئات المنتجات
            </a>
            <a href="{{route('products.transfers')}}" class="btn btn-outline-danger block btn-lg" >
                عمليات التحويل بين الفروع
            </a>
            <a href="{{route('products.import')}}" class="btn btn-outline-warning block btn-lg" >
                إستيراد من Excel
            </a>
          </div>
        </div>
      </div>
  <div class="content-body"><!-- users list start -->
<section class="users-list-wrapper">

    @if ($errors->any())
    <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>حدث خطأ, برجاء المحاولة مرة أخرى</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif



    @if(session()->has('success'))
        @if(session()->get('success') == 'product deleted' )
    <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>تم بنجاح!</strong> حذف بيانات منتج
    </div>

        @endif
    @endif
{{-- <div class="users-list-filter px-1">
  <form>
      <div class="row border border-light rounded py-2 mb-2">
          <div class="col-12 col-sm-6 col-lg-3">
              <label for="users-list-verified">Verified</label>
              <fieldset class="form-group">
                  <select class="form-control" id="users-list-verified">
                      <option value="">Any</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                  </select>
              </fieldset>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
              <label for="users-list-role">Role</label>
              <fieldset class="form-group">
                  <select class="form-control" id="users-list-role">
                      <option value="">Any</option>
                      <option value="User">User</option>
                      <option value="Staff">Staff</option>
                  </select>
              </fieldset>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
              <label for="users-list-status">Status</label>
              <fieldset class="form-group">
                  <select class="form-control" id="users-list-status">
                      <option value="">Any</option>
                      <option value="Active">Active</option>
                      <option value="Close">Close</option>
                      <option value="Banned">Banned</option>
                  </select>
              </fieldset>
          </div>
          <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
              <button class="btn btn-block btn-primary glow">Show</button>
          </div>
      </div>
  </form>
</div> --}}
<div class="users-list-table">
  <div class="card">
      <div class="card-content">
          <div class="card-body">
              <!-- datatable start -->
              <div class="table-responsive">
                <table id="list" class="table">
                    <thead>
                        <tr>
                            <th>مسلسل</th>
                            <th>بيانات المنتج</th>
                            <th>المخزون</th>
                            <th>سعر البيع</th>
                            <th>متوسط سعر الشراء</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><li class="la la-pencil-square"></li>
                                {{ $product->product_name }}
                                @if(isset($product->product_code))
                                <br/>
                                <li class="la la-barcode"></li>
                                {{ $product->product_code }}
                                @endif
                            </td>
                            <td>
                                @if($product->product_total_in - $product->product_total_out > 0 && $product->product_total_in - $product->product_total_out > 10)
                                <div class="badge badge-success">
                                    <i class="la la-thumbs-up font-medium-2"></i>
                                        <span>في المخزون</span>
                                    </div>
                                @elseif (($product->product_total_in - $product->product_total_out < 10) && ($product->product_total_in - $product->product_total_out) != 0)
                                    <div class="badge badge-warning">
                                        <i class="la la-exclamation-triangle font-medium-2"></i>
                                        <span>مخزون على وشك النفاذ</span>
                                    </div>
                                @else
                                    <div class="badge badge-danger">
                                        <i class="la la-exclamation-triangle font-medium-2"></i>
                                        <span>مخزون نفذ</span>
                                    </div>
                                    @endif
                                    <br>
                                <li class="la la-dropbox"></li>
                                 {{ $product->product_total_in - $product->product_total_out }}
                                </td>
                            <td><li class="la la-shopping-cart"></li>
                                @if(isset($product->product_price))
                                {{ $product->product_price }} ج.م
                                @else
                                <span>غير مسجل</span>
                                @endif
                            </td>
                            <td>
                                {{ $product->purchasesOrders() +0 }} ج.م
                            </td>

                            <td>
                                <a href="{{ route('products.view', $product->id) }}" class="btn btn-info btn-sm"><i class="la la-folder-open"></i> استعراض</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="la la-pencil-square-o"></i> تعديل</a>
                                <div class="btn-group" style="width: 170px">
                                    <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التحكم في المخزون</button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                        {{-- <a class="dropdown-item" href="{{route('products.addQty',$product->id)}}">أضف كمية يدويا</a> --}}
                                        <a class="dropdown-item" href="{{route('purchasesorders.add')}}">أمر شراء جديد</a>
                                        <a class="dropdown-item" href="{{route('products.transfer',$product->id)}}">تحويل كميات بين الفروع</a>

                                    </div>
                                </div>
                             </td>
                        </tr>
                        @endforeach
                     </tbody>
                </table>
              </div>
              <!-- datatable ends -->
          </div>
      </div>
  </div>
</div>
</section>
<!-- users list ends -->
  </div>
</div>
</div>
<!-- END: Content-->
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

$("#list").DataTable( {
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [4,3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [ 0,1,2,3,4 ]
                }
            }
        ]
    });


</script><!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
<!-- END: Page JS-->
@endsection
