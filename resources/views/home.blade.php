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
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- users view start -->
            <section id="card-gradient-options">
                <div class="row">
                    <div class="col-12 mt-3 mb-1">
                        <h4 class="text-uppercase">لوحة التحكم</h4>
                        <p>برنامج <code>Geture ERP</code> لإدارة الشركات</div>
                </div>

                <div class="row">
                    <div class="col-md-2 col-sm-6">
                        <div class="card text-white box-shadow-0 bg-gradient-x-secondary">
                            <div class="card-content collapse show">
                                <div class="card-body text-center">
                                    <a href="{{ route('invoices.list') }}">
                                    <h2>الفواتير</h2>
                                    <img style="width:100%" src="{{ asset('theme/app-assets/images/custom/invoice.png') }}" />
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="card text-white box-shadow-0 bg-gradient-x-primary">

                            <div class="card-content collapse show">
                                <div class="card-body text-center">
                                    <a href="{{ route('customers.list') }}">
                                    <h2>العملاء</h2>
                                    <img style="width:100%" src="{{ asset('theme/app-assets/images/custom/customersList.png') }}" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card text-white box-shadow-0 bg-gradient-x-success">

                            <div class="card-body text-center">
                                <a href="{{ route('suppliers.list') }}">
                                <h2>الموردين</h2>
                                <img style="width:100%" src="{{ asset('theme/app-assets/images/custom/suppliersList.png') }}" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="card text-white box-shadow-0 bg-gradient-x-info">
                            <div class="card-content collapse show">
                                <div class="card-body text-center">
                                    <a href="{{ route('products.list') }}">
                                    <h2>المنتجات</h2>
                                    <img style="width:100%" src="{{ asset('theme/app-assets/images/custom/productsList.png') }}" />
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6">
                    <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                        <div class="card-content collapse show">
                            <div class="card-body text-center">
                                <a href="{{ route('branches.list') }}">
                                <h2>الفروع</h2>
                                <img style="width:100%" src="{{ asset('theme/app-assets/images/custom/branchesList.png') }}" />
                                </a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="card text-white box-shadow-0 bg-gradient-x-danger">
                    <div class="card-content collapse show">
                        <div class="card-body text-center">
                            <a href="{{ route('safes.list') }}">
                            <h2>الخزن</h2>
                            <img style="width:100%" src="{{ asset('theme/app-assets/images/custom/safe.png') }}" />
                            </a>
                        </div>
                </div>
            </div>
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
