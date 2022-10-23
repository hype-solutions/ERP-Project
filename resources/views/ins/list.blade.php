@extends('layouts.erp')
@section('title', 'قائمة الدواخل')

@section('pageCss')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <!-- END: Page CSS-->
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">قائمة الدواخل</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('ins.list') }}">الدواخل</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                <div class="btn-group">
                    <a href="{{ route('ins.add') }}" class="btn btn-outline-success block btn-lg">
                        إضافه دواخل
                    </a>

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
                    @if (session()->get('success') == 'in Deleted')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> حذف بيانات فرع
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
                                    <table id="users-list-datatable" class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>التاريخ</th>
                                                <th>البند</th>
                                                <th>الخزنة</th>
                                                <th>رقم العملية في الخزنة</th>
                                                <th>الملاحظات</th>
                                                <th>المبلغ</th>
                                                <th>قام بالعملية</th>
                                                <th>صرح / رفض العملية</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ins as $in)
                                                <tr>
                                                    <td>{{ $in->id }}</td>
                                                    <td>{{ $in->transaction_datetime }}</td>
                                                    <td>
                                                        @if (isset($in->theCategory->category_name))
                                                            {{ $in->theCategory->category_name }}
                                                        @else
                                                            بدون بند
                                                        @endif
                                                    </td>
                                                    <td> {{ $in->safe->safe_name }}</td>
                                                    <td class="text-center">
                                                        @if ($in->safe_transaction_id > 0)
                                                            <b>{{ $in->safe_transaction_id }}</b>
                                                            <br>
                                                            <button
                                                                onclick="return pay('{{ route('safes.receipt', $in->safe_transaction_id) }}');"
                                                                class="btn btn-warning">الإيصال</button>
                                                        @else
                                                            @if ($in->rejected_by == 0)
                                                                <span class="danger">لم يتم التصديق عليها بعد</span>
                                                                <br>
                                                                <form action="{{ route('ins.authorizeIn', [$in->id, 1]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success">تصديق</button>
                                                                </form>
                                                                <form action="{{ route('ins.authorizeIn', [$in->id, 2]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                                                            class="la la-close"></i> رفض</button>
                                                                </form>
                                                            @endif
                                                        @endif

                                                    </td>
                                                    <td> {{ $in->notes }}
                                                        @if ($in->rejected_by > 0)
                                                            <span class="danger">عملية مرفوضة</span>
                                                        @endif
                                                    </td>
                                                    <td> {{ $in->amount }} ج.م</td>
                                                    <td>
                                                        <div class="badge border-primary primary badge-border">
                                                            <i class="la la-user font-medium-2"></i>
                                                            @if ($in->done_user)
                                                                <span>{{ $in->done_user->username }}</span>
                                                            @else
                                                                مستخدم محذوف
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if (isset($in->authorized_by) && isset($in->auth_user))
                                                            صرح بالعملية
                                                            <div
                                                                class="badge border-success success badge-square badge-border">
                                                                <i class="la la-user font-medium-2"></i>
                                                                <span>{{ $in->auth_user->username }}</span>
                                                            </div>
                                                        @endif
                                                        @if ($in->rejected_by > 0)
                                                            رفض العملية
                                                            <div
                                                                class="badge border-danger danger badge-square badge-border">
                                                                <i class="la la-user font-medium-2"></i>
                                                                <span>{{ $in->reject_user->username }}</span>
                                                            </div>
                                                        @endif

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
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->

    <script type="text/javascript">
        function pay(url) {
            popupWindow = window.open(
                url, 'popUpWindow',
                'height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no'
                )
        }
    </script>

    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
    <!-- END: Page JS-->
@endsection
