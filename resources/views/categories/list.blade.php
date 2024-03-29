@extends('layouts.erp')
@section('title', 'قائمة فئات المنتجات')

@section('pageCss')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">

    <!-- END: Page CSS-->
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">قائمة فئات المنتجات</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.list') }}">فئات المنتجات</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                <div class="btn-group">

                    <button data-toggle="modal" data-target="#default" class="btn btn-outline-success block btn-lg">
                        إضافه فئة جديدة
                    </button>
                    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">فئة جديدة</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form" method="post" action="{{ route('categories.adding') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="timesheetinput2">اسم الفئة</label>
                                                        <span style="color:red">*</span>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="timesheetinput2" class="form-control"
                                                                placeholder="" name="category_name" required>
                                                            <div class="form-control-position">
                                                                <i class="la la-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn grey btn-outline-secondary"
                                                data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                                            <button type="submit" class="btn btn-outline-primary"><i
                                                    class="la la-check-square-o"></i> حفظ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- users list start -->
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



                @if (session()->has('success'))
                    @if (session()->get('success') == 'product category Added')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> إضافة فئة جديدة
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
                                                <th>بيانات الفئة</th>
                                                <th>عدد الأصناف التابعة</th>
                                                <th>التحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $key => $category)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <li class="la la-pencil-square"></li>
                                                        {{ $category->cat_name }}
                                                    </td>
                                                    <td>{{ $category->product->count() }}</td>

                                                    <td>
                                                        <a href="{{ route('products.productsListByCat', $category->id) }}"
                                                            class="btn btn-info btn-sm"><i class="la la-folder-open"></i>
                                                            استعراض</a>
                                                        <button data-toggle="modal"
                                                            data-target="#edit_cat{{ $category->id }}"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="la la-pencil-square-o"></i>
                                                            تعديل</button>

                                                            <a href="{{route('categories.deleting',$category->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')"><i
                                                                class="la la-trash"></i> حذف</a>

                                                        <div class="modal fade text-left"
                                                            id="edit_cat{{ $category->id }}" tabindex="-1" role="dialog"
                                                            aria-labelledby="myModalLabel1" style="display: none;"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel1"> تعديل
                                                                        </h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form" method="post"
                                                                            action="{{ route('categories.editing', $category->id) }}">
                                                                            @csrf
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="timesheetinput2">الفئة</label>
                                                                                            <br />
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                name="category_name"
                                                                                                value="{{ $category->cat_name }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <button type="button"
                                                                                    class="btn grey btn-outline-secondary"
                                                                                    data-dismiss="modal"><i
                                                                                        class="ft-x"></i>
                                                                                    الغاء</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-primary"><i
                                                                                        class="la la-check-square-o"></i>
                                                                                    حفظ</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
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
    <script
        src="{{ asset('theme/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-print.min.js') }}">
    </script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/jszip.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script>
    <script>
        $("#list").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [2, 1, 0]
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ]
        });
    </script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
    <!-- END: Page JS-->
@endsection
