@extends('layouts.erp')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <!-- END: Page CSS-->
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')
<div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body"><!-- users view start -->
            <section id="card-gradient-options">

                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            @can('View POS')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('pos.landing') }}">
                                            <h4>البيع السريع</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/pos.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View PQ')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('invoicespricequotations.list') }}">
                                            <h4>عروض الأسعار</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/pq.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Invoices')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('invoices.list') }}">
                                            <h4>فواتير المبيعات</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/invoice.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Projects')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('projects.list') }}">
                                            <h4>إدارة المشاريع</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/projects.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                        <div class="row">
                            @can('View Branches')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('branches.list') }}">
                                            <h4 class="text-white">الفروع</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/branchesList.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Safes')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('safes.list') }}">
                                            <h4 class="text-white">الخزن</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/safe.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Customers')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('customers.list') }}">
                                            <h4 class="text-white">العملاء</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/customersList.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Suppliers')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                    <div class="card-body text-center">
                                        <a href="{{ route('suppliers.list') }}">
                                        <h4 class="text-white">الموردين</h4>
                                        <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/suppliersList.png') }}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                        <div class="row">
                            @can('View Products')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-info">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('products.list') }}">
                                            <h4 class="text-white">المخزن</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/productsList.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Income')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-success">
                                    <div class="card-body text-center">
                                        <a href="{{ route('ins.list') }}">
                                        <h4 class="text-white">الدواخل</h4>
                                        <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/income.png') }}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Expenses')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-danger">
                                    <div class="card-body text-center">
                                        <a href="{{ route('outs.list') }}">
                                        <h4 class="text-white">المصاريف</h4>
                                        <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/expenses.png') }}" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View PO')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-danger">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('purchasesorders.list') }}">
                                            <h4 class="text-white">أوامر الشراء</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/purchase-order.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                        <div class="row">
                            @can('View Users')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-grey-blue">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('users.list') }}">
                                            <h4 class="text-white">المستخدمين</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/users.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Roles')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-purple">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('settings.roles') }}">
                                            <h4 class="text-white">الصلاحيات</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/roles.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View General Settings')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-secondary">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('settings.list') }}">
                                            <h4 class="text-white">الإعدادات</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/settings.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('View Reports')
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="card text-white box-shadow-0 bg-gradient-x-pink">
                                    <div class="card-content collapse show">
                                        <div class="card-body text-center">
                                            <a href="{{ route('reports.landing') }}">
                                            <h4 class="text-white">التقارير</h4>
                                            <img style="width:65%" src="{{ asset('theme/app-assets/images/custom/reports.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                    <div class="col-6"></div>
                </div>
            </section>
        </div>
    </div>

@include('common.footer')
@endsection

@section('pageJs')
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->
@endsection
