@extends('layouts.erp')
@section('title', 'البيع السريع')

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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/simple-line-icons/style.min.css') }}">

    <!-- END: Page CSS-->
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">نقاط البيع</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.list') }}">نقاط البيع</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- users list start -->
            <script type="text/javascript">
                function pay(url) {
                    popupWindow = window.open(
                        url, 'popUpWindow',
                        'height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no'
                        )
                }
            </script>
            @if (session()->has('popup'))
                <script>
                    pay('{{ route('pos.receipt', session()->get('session')) }}');
                </script>
            @endif



            <section class="users-list-wrapper">
                @if (session()->has('error'))
                    @if (session()->get('error') == 'phone not unique')
                        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>خطأ!</strong> هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر
                        </div>
                    @endif
                @endif
                <form action="{{ route('pos.start') }}" method="POST" id="start">
                    @csrf
                    <input type="hidden" name="type" id="type" value="3" />
                    <section id="stats-icon-subtitle">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="media align-items-stretch">
                                            <div class="p-2 media-middle">
                                                <h1 class="dark">إختر الفرع</h1>
                                            </div>
                                            <div class="media-body p-2">
                                                <div class="form-group">
                                                    <label class="sr-only" for="projectinput6">الفرع</label>
                                                    <select name="branch" id="branch" class="select2-rtl form-control"
                                                        data-placeholder="الفرع" required>
                                                        <option></option>
                                                        @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}"
                                                                @if ($branches->count() == 1) selected @endif>
                                                                {{ $branch->branch_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="media-right bg-dark p-2 media-middle rounded-right">
                                                <i class="icon-home font-large-2 text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row match-height">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card text-white bg-primary text-center" style="height: 217px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4 class="card-title text-white">عميل جديد</h4>
                                                <div class="col-md-12">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control" placeholder="الإسم"
                                                            name="customer_name" id="new_customer_name">
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12">
                                                    <fieldset class="form-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="رقم التليفون" name="customer_mobile"
                                                            id="new_customer_mobile">
                                                    </fieldset>
                                                </div>
                                                <br>
                                                <button id="btnOne" class="btn btn-primary btn-darken-3 btn-block"
                                                    style="bottom: 0;position: absolute;right: 0;">عملية جديدة</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card text-white bg-success text-center" style="height: 217px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h3 class="card-title text-white">عميل حالي</h3>
                                                <div class="form-group">
                                                    <select class="select2-rtl form-control"
 
                                                        data-placeholder="إختر العميل..." name="customer_id" id="current_customer_id" required>
 
                                                        <option></option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}">
                                                                {{ $customer->customer_name }}

                                                                @if ($customer->customer_title)
                                                                    [{{ $customer->customer_title }}]
                                                                @endif
                                                                @if ($customer->customer_company)
                                                                    - {{ $customer->customer_company }}
                                                                @endif
                                                                @if ($customer->parent)
                                                                    - {{ $customer->parent->customer_company }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button id="btnTwo" class="btn btn-primary btn-darken-3 btn-block"
                                                    style="bottom: 0;position: absolute;right: 0;">عملية جديدة</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card text-white bg-warning text-center" style="height: 217px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4 class="card-title text-white">زائر</h4>
                                                <p class="card-text">عميل ليس له حساب و لا يريد التسجيل</p>
                                                <br />
                                                <button id="btnThree" class="btn btn-primary btn-darken-3 btn-block"
                                                    style="bottom: 0;position: absolute;right: 0;">عملية جديدة</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card text-white bg-danger text-center" style="height: 217px;">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4 class="card-title text-white">شحن طلبات</h4>
                                                <p class="card-text">قريبا</p>
                                                <br>
                                                <button class="btn btn-primary btn-darken-3 btn-block" disabled
                                                    style="bottom: 0;position: absolute;right: 0;">عملية جديدة</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                </form>
                <div class="col-md-6">
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header">
                                    <h2>الفواتير المفتوحة</h2>
                                </div>
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="list" class="table">
                                            <thead>
                                                <tr>
                                                    <th>رقم الفاتورة</th>
                                                    <th>مفتوحة منذ</th>
                                                    <th>فتحت بواسطة</th>
                                                    <th>الفرع</th>
                                                    <th>التحكم</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sessions as $key => $session)
                                                    <tr>
                                                        <td>{{ $session->id }}</td>
                                                        <td>{{ $session->created_at->diffForHumans() }}</td>
                                                        <td>
                                                            <div class="badge border-primary primary badge-border">
                                                                <i class="la la-user font-medium-2"></i>
                                                                <span>{{ $session->open_user->username }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $session->branch->branch_name }}</td>


                                                        <td>
                                                            <a href="{{ route('pos.index', $session->id) }}"
                                                                class="btn btn-info btn-sm"><i
                                                                    class="la la-folder-open"></i> استعراض</a>
                                                            <a href="{{ route('pos.cancel', $session->id) }}"
                                                                onclick="return confirm('سيتم الغاء العملية و إرجاع الكميات الى المخزن')"
                                                                class="btn btn-danger btn-sm"><i class="la la-trash"></i>
                                                                حذف</a>
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
    <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
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
    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>

    <script>
        $(function() {
            $("#btnOne").click(function(e) {
                e.preventDefault();
                if ($("#new_customer_name").val() === "") {
                    alert('أدخل إسم العميل الجديد');
                    return;
                }
                if ($("#new_customer_mobile").val() === "") {
                    alert('أدخل رقم موبايل العميل الجديد');
                    return;
                }
                $('#type').val(1);
                if ($("#branch").val() === "") {

                } else {
                    $("#start").submit(); // Submit the form
                }
            });
            $("#btnTwo").click(function(e) {
                e.preventDefault();
 
                if ($("#current_customer_id").val() === "") {
 
                    alert('إختر عميل من القائمة');
                    return;
                }
                $('#type').val(2);
                if ($("#branch").val() === "") {
                    alert('إختر الفرع');
                } else {
                    $("#start").submit(); // Submit the form
                }
            });
            $("#btnThree").click(function(e) {
                e.preventDefault();
                $('#type').val(3);
                if ($("#branch").val() === "") {
                    alert('إختر الفرع');
                } else {
                    $("#start").submit(); // Submit the form
                }
            });

        });


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
                        columns: [4, 3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [4, 3, 2, 1, 0]
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'سجل عمليات الخزن',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                }
            ]
        });
    </script><!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
    <!-- END: Page JS-->
@endsection
