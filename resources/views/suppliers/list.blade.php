@extends('layouts.erp')
@section('title', 'قائمة الموردين')

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
          <h3 class="content-header-title mb-0">قائمة الموردين</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('suppliers.list')}}">الموردين</a></li>
                <li class="breadcrumb-item active">استعراض
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
          <a href="{{route('suppliers.add')}}" class="btn btn-outline-success block btn-lg" >
                إضافه مورد جديد
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
        @if(session()->get('success') == 'Supplier deleted' )
    <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>تم بنجاح!</strong> حذف بيانات مورد
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
                            <th>رقم المورد</th>
                            <th>بيانات المورد</th>
                            <th>الموبايل</th>
                            <th>التليفون</th>
                            <th>الإيميل</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td><li class="la la-user"></li>
                                {{ $supplier->supplier_name }}
                                @if(isset($supplier->supplier_company))
                                <br/>
                                <li class="la la-home"></li>
                                {{ $supplier->supplier_company }}
                                @endif
                            </td>
                            <td><li class="la la-mobile"></li> {{ $supplier->supplier_mobile }}</td>
                            <td><li class="la la-phone"></li>
                                @if(isset($supplier->supplier_phone))
                                {{ $supplier->supplier_phone }}
                                @else
                                <span>غير مسجل</span>
                                @endif
                            </td>
                            <td><li class="la la-envelope"></li>
                                @if(isset($supplier->supplier_email))
                                {{ $supplier->supplier_email }}
                                @else
                                <span>غير مسجل</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('suppliers.view', $supplier->id) }}" class="btn btn-info btn-sm"><i class="la la-folder-open"></i> استعراض</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-primary btn-sm"><i class="la la-pencil-square-o"></i> تعديل</a>
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
                messageTop: 'قائمة الموردين',
                exportOptions: {
                    columns: [4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'قائمة الموردين',
                exportOptions: {
                    columns: [4,3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'قائمة الموردين',
                exportOptions: {
                    columns: [ 0, 1, 2,3 ,4 ]
                }
            }
        ]
    });
        </script>
<!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
 <!-- END: Page JS-->
@endsection
