@extends('layouts.erp')
@section('title', 'قائمة المستخدمين')

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
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">قائمة المستخدمين</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.list') }}">المستخدمين</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                <div class="btn-group">
                    <a href="{{ route('users.add') }}" class="btn btn-outline-success block btn-lg">
                        إضافه مستخدم جديد
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
                    @if (session()->get('success') == 'User Deleted')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> حذف بيانات مستخدم
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
                                    <table class="table" id="list">
                                        <thead>
                                            <tr>
                                                <th>رقم المستخدم</th>
                                                <th>نوع المستخدم</th>
                                                <th>الإسم</th>
                                                <th>Username</th>
                                                <th>التواصل</th>
                                                <th>التحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>
                                                        @if($user->role == 'مدير')
                                                        <button class="btn btn-block btn-outline-warning btn-sm">{{ $user->role }}</button>
                                                        @elseif($user->role == 'محاسب')
                                                        <button class="btn btn-block btn-outline-primary btn-sm">{{ $user->role }}</button>
                                                        @elseif($user->role == 'مسؤول مخازن')
                                                        <button class="btn btn-block btn-outline-success btn-sm">{{ $user->role }}</button>
                                                        @elseif($user->role == 'مدير فروع')
                                                        <button class="btn btn-block btn-outline-dark btn-sm">{{ $user->role }}</button>
                                                        @elseif($user->role == 'مسؤول مبيعات')
                                                        <button class="btn btn-block btn-outline-danger btn-sm">{{ $user->role }}</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <li class="la la-user"></li>
                                                        {{ $user->name }}
                                                    </td>
                                                    <td>
                                                        <li class="la la-lock"></li>
                                                        @if (isset($user->username))
                                                            {{ $user->username }}
                                                        @else
                                                            <span>غير مسجل</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <li class="la la-mobile"></li>
                                                        @if (isset($user->mobile))
                                                            {{ $user->mobile }}
                                                        @else
                                                            <span class="danger">غير مسجل</span>
                                                        @endif
                                                        <br>
                                                        <li class="la la-envelope"></li>
                                                        @if (isset($user->email))
                                                            {{ $user->email }}
                                                        @else
                                                            <span class="danger">غير مسجل</span>
                                                        @endif

                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <div class="btn-group" role="group"
                                                                aria-label="Button group with nested dropdown">
                                                                <a href="{{ route('users.view', $user->id) }}"
                                                                    class="btn btn-outline-info  btn-sm"><i
                                                                        class="la la-folder-open"></i>
                                                                    استعراض</a>
                                                                <div class="btn-group" role="group">
                                                                    <button id="btnGroupDrop2" type="button"
                                                                        class="btn btn-outline-info dropdown-toggle  btn-sm"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        التحكم
                                                                    </button>
                                                                    <div class="dropdown-menu" style="width: fit-content"
                                                                        aria-labelledby="btnGroupDrop2"
                                                                        x-placement="bottom-start"
                                                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('users.edit', $user->id) }}"><i
                                                                                class="la la-pencil-square-o"></i> تعديل</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('users.permissions', $user->id) }}"><i
                                                                                class="la la-balance-scale"></i> تعديل
                                                                            الصلاحيات</a>
                                                                            <form action="{{route('users.sendResetPassword')}}" method="post">
                                                                                @csrf
                                                                            <button class="dropdown-item"
                                                                            type="submit"><i
                                                                                class="la la-lock"></i> أرسل كلمة مرور جديدة</button>
                                                                            </form>
                                                                            <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#"
                                                                            data-toggle="modal"
                                                                            data-target="#edit_profilePicture{{ $user->id }}"><i
                                                                                class="la la-pencil-square-o"></i> تغيير
                                                                            الصورة</a>
                                                                        <a class="dropdown-item" href="#"
                                                                            data-toggle="modal"
                                                                            data-target="#edit_signature{{ $user->id }}"><i
                                                                                class="la la-pencil-square-o"></i> تغيير
                                                                            التوقيع</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item"
                                                                            href="#"><i
                                                                                class="la la-exchange"></i> سجل
                                                                            الحركات</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم نهائيا و جميع تفاصيله من البرنامج')"
                                                                            href="{{ route('users.delete', $user->id) }}"><i
                                                                                class="la la-trash"></i>حذف</a>
                                                                    </div>
                                                                </div>
                                                                <div class="btn-group"  role="group">
                                                                    <button type="button"
                                                                        class="btn btn-outline-info dropdown-toggle  btn-sm"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false"> التواصل مع
                                                                        المستخدم</button>
                                                                    <div class="dropdown-menu" x-placement="bottom-start"
                                                                        style="width:fit-content;position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                                        @if (isset($user->mobile))
                                                                            <a class="dropdown-item"
                                                                                href="tel:{{ $user->mobile }}">اتصال بالموبايل
                                                                            </a>
                                                                        @else
                                                                            <button class="dropdown-item" disabled>اتصال بالموبايل
                                                                                <small style="color: red">غير
                                                                                    مسجل</small></button>
                                                                        @endif

                                                                        <button class="dropdown-item" disabled>ارسال SMS <small
                                                                                style="color: red">غير
                                                                                متاحة</small></button>
                                                                        @if (isset($user->email))
                                                                            <a class="dropdown-item"
                                                                                href="mailto:{{ $user->email }}"> ارسال ايميل</a>
                                                                        @else
                                                                            <button class="dropdown-item" disabled> ارسال
                                                                                ايميل<small style="color: red">غير
                                                                                    مسجل</small></button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade text-left"
                                                            id="edit_profilePicture{{ $user->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel1"
                                                            style="display: none;" aria-hidden="true">
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
                                                                            action="{{ route('users.profilepic', $user->id) }}"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('patch')
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="timesheetinput2">الصورة
                                                                                                الشخصية</label>
                                                                                            <br />
                                                                                            <input type="file"
                                                                                                name="profile_pic" id="">
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

                                                        <div class="modal fade text-left"
                                                            id="edit_signature{{ $user->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel1"
                                                            style="display: none;" aria-hidden="true">
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
                                                                            action="{{ route('users.signature', $user->id) }}"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('patch')
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="timesheetinput2">التوقيع</label>
                                                                                            <br />
                                                                                            <input type="file"
                                                                                                name="signature" id="">
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
                    messageTop: 'قائمة المستخدمين',
                    exportOptions: {
                        columns: [4, 3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'قائمة المستخدمين',
                    exportOptions: {
                        columns: [ 4, 3, 2, 1, 0]
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'قائمة المستخدمين',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
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
