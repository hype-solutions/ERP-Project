@extends('layouts.erp')
@section('title', 'عمليات التحويل بين المخازن')

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
                <h3 class="content-header-title mb-0">عمليات التحويل بين المخازن</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.list') }}">المنتجات</a></li>
                            <li class="breadcrumb-item active">عمليات التحويل بين المخازن
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            {{-- <div class="content-header-right text-md-right col-md-6 col-12">
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
          </div>
        </div> --}}
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
                    @if (session()->get('success') == 'product deleted')
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
                                            @if (isset($transfers))
                                                @foreach ($transfers as $key => $transfer)
                                                @if ($transfer->status == 'Rejected')
                                                    <tr style="background-color: #f5d2d2 !important;">
                                                @elseif ($transfer->status == 'Transfered')
                                                    <tr style="background-color: #cff1cf !important;">
                                                @elseif ($transfer->status == 'Pending')
                                                <tr style="background-color: #fff1ae !important;">
                                                @endif
                                                        {{-- <td>{{++$key}}</td> --}}
                                                        <td>
                                                            <div class="badge border-info info badge-border">
                                                                <a href="#" target="_blank"
                                                                    style="color: #1e9ff2"><span>{{ $transfer->id }}</span></a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $transfer->transfer_datetime }}
                                                        </td>
                                                        <td>
                                                            @if (isset($transfer->branchFrom))

                                                                <div class="badge badge-success">
                                                                    <i class="la la-flag font-medium-2"></i>
                                                                    <span>{{ $transfer->branchFrom->branch_name }}</span>
                                                                </div>

                                                            @else
                                                                <div class="badge badge-danger">
                                                                    <i class="la la-trash font-medium-2"></i>
                                                                    <span>{{ str_replace('عملية تحويل كميات من فرع الى أخر بسبب حذف فرع, اسم الفرع قبل الحذف ', '', $transfer->transfer_notes) }}</span>
                                                                </div>
                                                                <span style="color: red">(فرع محذوف)</span>
                                                            @endif
                                                            <hr>
                                                            المخزون قبل:
                                                            {{ $transfer->qty_before_transfer_from }}
                                                            <br>
                                                            المخزون بعد:
                                                            {{ $transfer->qty_after_transfer_from }}
                                                        </td>
                                                        <td>
                                                            @if (isset($transfer->branchTo))

                                                                <div class="badge badge-warning">
                                                                    <i class="la la-arrow-left font-medium-2"></i>
                                                                    <span>{{ $transfer->branchTo->branch_name }}</span>
                                                                </div>

                                                            @else
                                                                <div class="badge badge-danger">
                                                                    <i class="la la-trash font-medium-2"></i>
                                                                    <span>{{ str_replace('عملية تحويل كميات من فرع الى أخر بسبب حذف فرع, اسم الفرع قبل الحذف ', '', $transfer->transfer_notes) }}</span>
                                                                </div>
                                                                <span style="color: red">(فرع فرع محذوف)</span>
                                                            @endif
                                                            <hr>
                                                            المخزون قبل:
                                                            {{ $transfer->qty_before_transfer_to }}
                                                            <br>
                                                            المخزون بعد: {{ $transfer->qty_after_transfer_to }}
                                                        </td>
                                                        <td>{{ $transfer->transfer_qty }}</td>
                                                        <td>
                                                            قام بالتحويل
                                                            <div class="badge border-primary primary badge-border">
                                                                <i class="la la-user font-medium-2"></i>
                                                                <span>{{ $transfer->transferUser->username }}</span>
                                                            </div>

                                                            @if ($transfer->status == 'Transfered')
                                                                <br>
                                                                صرح بالتحويل
                                                                <div
                                                                    class="badge border-success success badge-square badge-border">
                                                                    <i class="la la-user font-medium-2"></i>
                                                                    <span>{{ $transfer->authUser->username }}</span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $transfer->transfer_notes }}
                                                        </td>
                                                        <td>
                                                            @if ($transfer->status == 'Rejected')
                                                                <p class="danger">تم رفض التحويل</p>
                                                            @elseif ($transfer->status == 'Transfered')
                                                            <p class="success">تم التحويل</p>

                                                            @elseif ($transfer->status == 'Pending')
                                                                @if ($transfer->branchFrom->getProductAmountInBranch($transfer->product_id)->amount >= $transfer->transfer_qty)
                                                                    <a href="{{ route('products.acceptingTransfer', $transfer->id) }}"
                                                                        class="btn btn-success btn-block">تصديق على
                                                                        التحويل</a>
                                                                @else
                                                                <button class="btn btn-success btn-sm " disabled>لا توجد كمية تكفي للتحويل</button>
                                                                @endif
                                                                <a href="{{route('products.rejectingTransfer',$transfer->id)}}" class="btn btn-danger btn-sm">رفض</a>
                                                                @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
            order: [ 0, 'desc' ],
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [6, 5,4, 3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [6, 5,4, 3, 2, 1, 0]
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4,5,6]
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
