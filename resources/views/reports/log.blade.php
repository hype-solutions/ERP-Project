@extends('layouts.erp')
@section('title', 'حركات المستخدمين')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/timeline.min.css') }}">
    <!-- END: Page CSS-->
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">التقارير</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('reports.landing')}}">التقارير</a></li>
                <li class="breadcrumb-item active">تقارير حركات المستخدمين
                </li>
              </ol>
            </div>
          </div>
        </div>

      </div>
  <div class="content-body"><!-- users list start -->
<section class="users-list-wrapper">
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{route('reports.log.search')}}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="form-group col-md-4 ">
                                        <label>من</label>
                                        <input type="date" class="form-control" name="from" value="{{$fromX}}"/>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label>الى</label>
                                        <input type="date" class="form-control" name="to" value="{{$toX}}"/>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label  >الفرع</label>
                                        <select id="projectinput6" name="branch" class="form-control">
                                            <option value="{{$branch}}">تغيير الفرع</option>
                                             @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-check-square-o"></i> إستعراض
                                    </button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </div>
</div>

                <section id="timeline" class="timeline-left timeline-wrapper">
                    <h3 class="page-title text-center text-lg-left">حركات المستخدمين</h3>

                    @foreach($dates as $date)
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        <li class="timeline-group">
                            <a href="#" class="btn btn-dark"><i class="ft-calendar"></i>
                                 {{$date->formatLocalized('%A %d %B %Y')}}
                                </a>
                        </li>
                    </ul>
                    <ul class="timeline">
                        <li class="timeline-line"></li>
                        @foreach ($logs as $log)
                        @if($log->action_date->format('Y-m-d') == $date->format('Y-m-d'))
                        <li class="timeline-item">
                            <div class="timeline-badge">
                                @if($log->action == 'Add')
                                <span class="bg-success bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-plus"></i>
                                </span>
                                @elseif($log->action == 'Edit')
                                <span class="bg-info bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-pencil"></i>
                                </span>
                                @elseif($log->action == 'Delete')
                                <span class="bg-red bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-trash"></i>
                                </span>
                                @elseif($log->action == 'Print')
                                <span class="bg-pink bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-print"></i>
                                </span>
                                @elseif($log->action == 'View')
                                <span class="bg-warning bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-eye"></i>
                                </span>
                                @elseif($log->action == 'Login')
                                <span class="bg-success bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-sign-in"></i>
                                </span>
                                @elseif($log->action == 'Logout')
                                <span class="bg-yellow bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Portfolio project work">
                                    <i class="la la-sign-out"></i>
                                </span>
                                @endif
                            </div>
                            <div class="timeline-card card border-grey border-lighten-2">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        قام
                                        <a href="{{route('users.view',$log->user_id)}}" target="_blank" class="btn btn-outline-primary btn-min-width mr-1">
                                            {{$log->user->name}}
                                        </a>
                                        @if($log->action == 'Add')
                                        بإضافة
                                        @elseif($log->action == 'Edit')
                                        بتعديل
                                        @elseif($log->action == 'Delete')
                                        بحذف
                                        @elseif($log->action == 'Print')
                                        بطباعة
                                        @elseif($log->action == 'View')
                                        بإستعراض
                                        @elseif($log->action == 'Login')
                                        بتسجيل الدخول الى البرنامج
                                        @elseif($log->action == 'Logout')
                                        بتسجيل الخروج من البرنامج

                                        @endif

                                        @if($log->type == 'Invoices')
                                        <a href="{{route('invoices.view',$log->custom_id)}}" target="_blank" class="btn btn-outline-secondary  btn-min-width mr-1">
                                        فاتورة
                                        </a>
                                        @elseif($log->type == 'Branches')
                                        <a href="{{route('branches.view',$log->custom_id)}}" target="_blank" class="btn btn-outline-secondary  btn-min-width mr-1">
                                        فرع
                                        </a>
                                        @elseif($log->type == 'Customers')
                                        <a href="{{route('customers.view',$log->custom_id)}}" target="_blank" class="btn btn-outline-secondary  btn-min-width mr-1">
                                        عميل
                                        </a>
                                        @elseif($log->type == 'Suppliers')
                                        <a href="{{route('suppliers.view',$log->custom_id)}}" target="_blank" class="btn btn-outline-secondary  btn-min-width mr-1">
                                        مورد
                                        </a>
                                        @elseif($log->type == 'Installment')
                                        <a href="{{route('invoices.view',$log->custom_id)}}" target="_blank" class="btn btn-outline-secondary  btn-min-width mr-1">
                                        قسط
                                        </a>
                                        @endif
                                    </h4>

                                    <p class="card-subtitle text-muted pt-1">
                                        <span class="font-small-3"> {{$log->action_date->formatLocalized('%I:%M %p')}} </span>
                                    </p>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>

                                </div>
                                {{-- <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">بيانات المستخدم:</div>
                                            <div class="col-md-6">بيانات العملية:</div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </li>
                        @endif
                        @endforeach

                    </ul>
                    @endforeach
                </section>


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
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script><!-- END: Page Vendor JS-->
<!-- END: Page Vendor JS-->
<script>

    $("#invoices").DataTable( {
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'قائمة فواتير المبيعات',
                exportOptions: {
                    columns: [3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'قائمة فواتير المبيعات',
                exportOptions: {
                    columns: [3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'قائمة فواتير المبيعات',
                exportOptions: {
                    columns: [ 0, 1, 2,3 ]
                }
            }
        ]
    });

    $("#sessions").DataTable( {
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'قائمة فواتير البيع السريع',
                exportOptions: {
                    columns: [2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'قائمة فواتير البيع السريع',
                exportOptions: {
                    columns: [2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'قائمة فواتير البيع السريع',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            }
        ]
    });
        </script>
    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/timeline.min.js') }}"></script>
<!-- END: Page JS-->
@endsection
