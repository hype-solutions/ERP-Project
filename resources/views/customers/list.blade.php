@extends('layouts.erp')
@section('title', 'قائمة العملاء')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/DataTables/datatables.min.css') }}">

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
                <h3 class="content-header-title mb-0">قائمة العملاء</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.list') }}">العملاء</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                <div class="btn-group">
                    <a href="{{ route('customers.add') }}" class="btn btn-outline-success block btn-lg">
                        إضافه عميل جديد
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



                @if (session()->has('success'))
                    @if (session()->get('success') == 'Customer deleted')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> حذف بيانات عميل
                        </div>
                    @endif
                @endif

                <div class="users-list-table">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table class="table" id="list">
                                        <thead>
                                            <tr>
                                                <th>رقم العميل</th>
                                                <th>بيانات العميل</th>
                                                <th>الموبايل</th>
                                                <th>التليفون</th>
                                                <th>الإيميل</th>
                                                <th>التحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td>{{ $customer->id }}</td>
                                                    <td>
                                                        <li class="la la-user"></li>
                                                        {{ $customer->customer_name }}
                                                        @if (isset($customer->customer_title))
                                                            <br />
                                                            <li class="la la-briefcase"></li>
                                                            {{ $customer->customer_title }}
                                                        @endif
                                                        @if (isset($customer->customer_company))
                                                            <br />
                                                            <li class="la la-home"></li>
                                                            {{ $customer->customer_company }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <li class="la la-mobile"></li> {{ $customer->customer_mobile }}
                                                    </td>
                                                    <td>
                                                        <li class="la la-phone"></li>
                                                        @if (isset($customer->customer_phone))
                                                            {{ $customer->customer_phone }}
                                                        @else
                                                            <span>غير مسجل</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <li class="la la-envelope"></li>
                                                        @if (isset($customer->customer_email))
                                                            {{ $customer->customer_email }}
                                                        @else
                                                            <span>غير مسجل</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="mycontrol" style="width: max-content;">
                                                            <a href="{{ route('customers.view', $customer->id) }}"
                                                                class="btn btn-info btn-sm"><i
                                                                    class="la la-folder-open"></i> استعراض</a>
                                                            <a href="{{ route('customers.edit', $customer->id) }}"
                                                                class="btn btn-primary btn-sm"><i
                                                                    class="la la-pencil-square-o"></i> تعديل</a>
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
    <script src="{{ asset('theme/app-assets/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/DataTables/customDatatable.js') }}"></script>
    <script>
        initalizeDatatable('list','قائمة العملاء',5);
    </script>
@endsection
