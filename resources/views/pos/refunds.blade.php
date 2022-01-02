@extends('layouts.erp')
@section('title', 'البيع السريع')

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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
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
                            <li class="breadcrumb-item active">المرتجعات
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
                    pay("{{ route('pos.receipt', session()->get('session')) }}");
                </script>
            @endif
            @if (session()->has('refunded'))
            <script>
                pay("{{ route('pos.refund.receipt', session()->get('session')) }}");
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

                <section id="stats-icon-subtitle">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="media align-items-stretch">
                                        <div class="p-2 media-middle">
                                            <h1 class="dark">البحث عن الفاتورة</h1>
                                        </div>
                                        <div class="media-body p-2">
                                            <form action="{{ route('pos.refunds.search') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="sr-only" for="projectinput6">الرقم</label>
                                                    <input type="text" name="query" class="typeahead form-control"
                                                        id="posid" placeholder="أدخل رقم الفاتورة" autocomplete="off">
                                                    <p id="noResults" class="danger" style="display:none">عفوا, لا
                                                        توجد نتائج</p>
                                                    <table class="table table-bordered table-hover" style="display:none"
                                                        id="resultsTable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>بيعت بواسطة</th>
                                                                <th>الفرع</th>
                                                                <th>العميل</th>
                                                                <th>الوقت</th>
                                                                <th>الإجمالي</th>
                                                                <th>-</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="resultsBody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="media-right bg-dark p-2 media-middle rounded-right">
                                            <i class="icon-magnifier font-large-2 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">


                    <div class="col-md-12">
                        <div class="users-list-table">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header">
                                        <h2>اخر 10 فواتير</h2>
                                    </div>
                                    <div class="card-body">
                                        <!-- datatable start -->
                                        <div class="table-responsive">
                                            <table id="list" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>بيعت بواسطة</th>
                                                        <th>الفرع</th>
                                                        <th>العميل</th>
                                                        <th>الوقت</th>
                                                        <th>الإجمالي</th>
                                                        <th>-</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sessions as $key => $session)
                                                        <tr>
                                                            <td>{{ $session->id }}</td>
                                                            <td>{{ $session->sell_user->username }}</td>
                                                            <td>{{ $session->branch->branch_name }}</td>
                                                            <td>{{ $session->customer ? $session->customer->customer_name : 'زائر' }}</td>
                                                            <td>{{ $session->sold_when }}</td>
                                                            <td>{{ $session->total }}</td>
                                                            {{-- <td>
                                                                <div class="badge border-primary primary badge-border">
                                                                    <i class="la la-user font-medium-2"></i>
                                                                    <span>{{ $session->open_user->username }}</span>
                                                                </div>
                                                            </td> --}}
                                                            {{-- <td>{{ $session->branch->branch_name }}</td> --}}


                                                            <td>
                                                                <a href="{{ route('pos.refunds.view', $session->id) }}"
                                                                    class="btn btn-info btn-sm"><i
                                                                        class="la la-folder-open"></i> إختر</a>

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


            $('#posid').on('keyup', function() {
                $value = $(this).val();
                if ($value) {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        type: 'post',
                        url: '{{ route("pos.refunds.search") }}',
                        data: {
                            'search': $value,
                            _token: _token
                        },
                        success: function(data) {
                            if (data.length > 0) {
                                $('#noResults').hide();
                                $('#resultsTable').show();
                                $('#resultsBody').html(data);
                            } else {
                                $('#noResults').show();
                                $('#resultsTable').hide();
                            }
                        }
                    });
                } else {
                    $('#resultsTable').hide();
                    $('#noResults').hide();
                }
            })




            $("#btnOne").click(function(e) {
                e.preventDefault();
                $('#type').val(1);
                if ($("#branch").val() === "") {
                    alert('إختر الفرع');
                } else {
                    $("#start").submit(); // Submit the form
                }
            });
            $("#btnTwo").click(function(e) {
                e.preventDefault();
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
    </script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
    <!-- END: Page JS-->
@endsection
