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
                    <div class="col-md-4 col-sm-12">
                        <div class="card text-white box-shadow-0 bg-gradient-x-primary">
                            <div class="card-header">
                                <h4 class="card-title text-white">العملاء</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <p class="card-text">تم الإنتهاء من:
                                        <ul>
                                            <li><a href="{{route('customers.list')}}">قائمة العملاء</a></li>
                                            <li><a href="{{route('customers.add')}}">إضافة عميل</a></li>
                                            <li>استعراض ملف العميل</li>
                                            <li>تعديل عميل</li>
                                            <li>حذف عميل</li>
                                        </ul>
                                    </p>
                                    <p class="card-text">متبقي:
                                        <ul>
                                            <li>الأصناف الأكثر طلبا</li>
                                            <li> فواتير العميل</li>
                                            <li>عروض أسعار العميل</li>
                                            <li>المبالغ المستحقة</li>

                                        </ul>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="card text-white box-shadow-0 bg-gradient-x-success">
                            <div class="card-header">
                                <h4 class="card-title text-white">الموردين</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <p class="card-text">تم الإنتهاء من:
                                        <ul>
                                        <li><a href="{{route('suppliers.list')}}">قائمة الموردين</a></li>
                                            <li><a href="{{route('suppliers.add')}}">إضافة مورد</a></li>
                                            <li>استعراض ملف المورد</li>
                                            <li>تعديل مورد</li>
                                            <li>حذف مورد</li>
                                        </ul>
                                        <p class="card-text">متبقي:
                                            <ul>
                                                <li>أصناف العميل</li>
                                                <li> أوامر الشراء</li>
                                                <li>المبالغ المستحقة</li>

                                            </ul>
                                        </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                            <div class="card-header">
                                <h4 class="card-title text-white">المصاريف</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <p class="card-text">لم يتم البدء فيه</p>
                                </div>
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
