@extends('layouts.erp')
@section('title', 'ملف مستخدم ' . $user->name)

@section('pageCss')
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
    <!-- END: Vendor CSS-->
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users view start -->
            <section class="users-view">
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('users.list') }}">المستخدمين</a></li>
                                    <li class="breadcrumb-item active">ملف مستخدم
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="media mb-2">
                            <a class="mr-1" href="#">
                                <img src="{{ asset('theme/app-assets/images/custom/client.svg') }}"
                                    alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64"
                                    width="64">
                            </a>
                            <div class="media-body pt-25">
                                <h4 class="media-heading"><span class="users-view-name">{{ $user->name }} </span>
                                </h4>
                                <span>رقم المستخدم:</span>
                                <span class="users-view-id">
                                    <span class="badge badge-success users-view-status">{{ $user->id }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        <div class="btn-group mr-1 mb-1">
                            <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="width:fit-content;position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                        class="la la-pencil-square-o"></i> تعديل</a>
                                <a class="dropdown-item" href="{{ route('users.permissions', $user->id) }}"><i
                                        class="la la-balance-scale"></i> تعديل
                                    الصلاحيات</a>
                                <a class="dropdown-item" href="#"><i class="la la-lock"></i> تعديل
                                    كلمة المرور</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#edit_profilePicture{{ $user->id }}"><i
                                        class="la la-pencil-square-o"></i> تغيير
                                    الصورة</a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#edit_signature{{ $user->id }}"><i class="la la-pencil-square-o"></i>
                                    تغيير
                                    التوقيع</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="la la-exchange"></i> سجل
                                    الحركات</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item btn-danger"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم نهائيا و جميع تفاصيله من البرنامج')"
                                    href="{{ route('users.delete', $user->id) }}"><i class="la la-trash"></i>حذف</a>
                            </div>
                        </div>
                        <div class="btn-group mr-1 mb-1">
                            <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التواصل مع
                                المستخدم</button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                @if (isset($user->mobile))
                                    <a class="dropdown-item" href="tel:{{ $user->mobile }}">اتصال بالموبايل </a>
                                @else
                                    <button class="dropdown-item" disabled>اتصال بالموبايل <small style="color: red">غير
                                            مسجل</small></button>
                                @endif

                                <button class="dropdown-item" disabled>ارسال SMS <small style="color: red">غير
                                        متاحة</small></button>
                                @if (isset($user->email))
                                    <a class="dropdown-item" href="mailto:{{ $user->email }}"> ارسال ايميل</a>
                                @else
                                    <button class="dropdown-item" disabled> ارسال ايميل<small style="color: red">غير
                                            مسجل</small></button>
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
                                                <td>الإسم:</td>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>الصلاحيات:</td>
                                                <td>
                                                    {{ $user->role }}
                                                    {{-- {{$user->roles[0]->name}} --}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>الموبايل:</td>
                                                <td>
                                                    @if (isset($user->mobile))
                                                        {{ $user->mobile }}
                                                    @else
                                                        <span class="danger">غير مسجل</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>username:</td>
                                                <td>{{ $user->username }}</td>
                                            </tr>

                                            <tr>
                                                <td>الايميل:</td>
                                                <td>
                                                    @if (isset($user->email))
                                                        {{ $user->email }}
                                                    @else
                                                        <small class="danger">غير مسجل</small>
                                                    @endif
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xl-6 col-lg-12 mb-1">
                                    <div class="form-group text-center">
                                        <!-- Floating Outline button with text -->
                                        <button type="button" class="btn btn-float btn-outline-cyan"
                                            style="cursor: context-menu"><i class="">0</i><span>عدد فواتير
                                                الشراء</span></button>
                                        <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"
                                            style="cursor: context-menu"><i class="">0 ج,م</i><span>إجمالي
                                                المبالغ من الفواتير</span></button>
                                        <button type="button" class="btn btn-float btn-outline-cyan"
                                            style="cursor: context-menu"><i class="">0</i><span>عدد عروض
                                                الأسعار</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>الصورة الشخصية</h4>
                                <button class="btn btn-warning" type="button" data-toggle="modal"
                                    data-target="#edit_profilePicture{{ $user->id }}"><i
                                        class="la la-pencil-square-o"></i> تغيير
                                    الصورة</button>
                                <div class="modal fade text-left" id="edit_profilePicture{{ $user->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1"> تعديل
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
                                                                    <label for="timesheetinput2">الصورة
                                                                        الشخصية</label>
                                                                    <br />
                                                                    <input type="file" name="profile_pic" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                            data-dismiss="modal"><i class="ft-x"></i>
                                                            الغاء</button>
                                                        <button type="submit" class="btn btn-outline-primary"><i
                                                                class="la la-check-square-o"></i>
                                                            حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (!empty($user->profile_pic))
                                    <img src="{{ asset($user->profile_pic) }}" style="max-width:100%;"
                                        class="frame" />
                                @else
                                    <img src="{{ asset('theme/app-assets/images/custom/no-profile.jpg') }}"
                                        style="max-width:100%;" class="frame" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>التوقيع</h4>
                                <button class="btn btn-warning" type="button" data-toggle="modal"
                                    data-target="#edit_signature{{ $user->id }}"><i class="la la-pencil-square-o"></i>
                                    تغيير
                                    التوقيع</button>
                                <div class="modal fade text-left" id="edit_signature{{ $user->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1"> تعديل
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
                                                                    <label for="timesheetinput2">التوقيع</label>
                                                                    <br />
                                                                    <input type="file" name="signature" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                            data-dismiss="modal"><i class="ft-x"></i>
                                                            الغاء</button>
                                                        <button type="submit" class="btn btn-outline-primary"><i
                                                                class="la la-check-square-o"></i>
                                                            حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (!empty($user->signature))
                                    <img src="{{ asset($user->signature) }}" style="max-width:100%;"
                                        class="frame" />
                                @else
                                    <img src="{{ asset('theme/app-assets/images/custom/no-signature.jpg') }}"
                                        style="max-width:100%;" class="frame" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- users view card data ends -->

                {{-- <div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-content">
        <div class="card-body">

          <div class="col-12">
             <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> فاتورة جديدة</a>
              <h2 style="text-align: center">الفواتير</h2>

          </div>
        </div>
      </div>
    </div>
    </div>
  <div class="col-md-6">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <div class="col-12">
            <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> عرض سعر جديد</a>
            <h2 style="text-align: center">عروض الأسعار</h2>

        </div>
      </div>
    </div>
  </div>
  </div>
</div> --}}
                {{-- <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-content">
          <div class="card-body">

            <div class="col-12">
                <h2 style="text-align: center">المبالغ المستحقة</h2>

            </div>
          </div>
        </div>
      </div>
      </div>
    <div class="col-md-6">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="col-12">
              <h2 style="text-align: center">الأصناف الأكثر طلبا</h2>

          </div>
        </div>
      </div>
    </div>
    </div>
  </div> --}}

                <!-- users view card details ends -->

            </section>
            <!-- users view ends -->
        </div>
    </div>



    @include('common.footer')
@endsection

<style>
    .frame {
        display: block;
        background: transparent;
        padding: 8px;
        border: 1px solid #ccc;
        box-shadow: 10px 10px 10px #999;
    }

</style>
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
    <!-- END: Page Vendor JS-->
    <script>
        $("#reciepts").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'فواتير المستخدم {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [2, 1, 0]
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
                    messageTop: 'فواتير المستخدم \n {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [2, 1, 0],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'فواتير المستخدم {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ]
        });
        $("#quotations").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'عروض أسعار {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'عروض أسعار \n {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'عروض أسعار {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ]
        });
        $("#due").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'المبالغ المستحقة على {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'المبالغ المستحقة على \n {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'المبالغ المستحقة على {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ]
        });
        $("#most-ordered").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'الأصناف الأكثر طلبا ل {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'الأصناف الأكثر طلبا ل \n {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [1, 0]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'الأصناف الأكثر طلبا ل {{ $user->customer_name }}',
                    exportOptions: {
                        columns: [0, 1]
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
