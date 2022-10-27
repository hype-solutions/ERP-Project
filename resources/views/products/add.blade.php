@extends('layouts.erp')
@section('title', 'إضافة منتج')

@section('pageCss')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/switch.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-switch.min.css') }}">



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
                    @if (session()->get('success') == 'product Added')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> إضافة منتج جديد
                        </div>
                    @endif
                @endif
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('products.list') }}">المنتجات</a></li>
                                    <li class="breadcrumb-item active">إضافة منتج جديد
                                    </li>
                                </ol>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                {{-- <p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p> --}}

                            </div>
                            <form class="form" method="post" action="{{ route('products.adding') }}">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> بيانات المنتج</h4>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="timesheetinput2">اسم المنتج</label>
                                                <span style="color:red">*</span>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="timesheetinput2" class="form-control"
                                                        value="{{ old('product_name') }}" name="product_name" required>
                                                    <div class="form-control-position">
                                                        <i class="la la-pencil-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="timesheetinput2">كود المنتج</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="timesheetinput2" class="form-control"
                                                        name="product_code" value="{{ old('product_code') }}"
                                                         onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">>
                                                    <div class="form-control-position">
                                                        <i class="la la-barcode"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="text-bold-600 font-medium-2">
                                                    الفئة
                                                </div>
                                                <select class="select2-rtl form-control" data-placeholder="إختر الفئة..."
                                                    name="product_category">
                                                    <option> </option>
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('product_category') == $item->id ? 'selected ' : '' }}>
                                                            {{ $item->cat_name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="timesheetinput2">الماركة</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="timesheetinput2" class="form-control"
                                                        placeholder="مثال: بفاريا" name="product_brand"
                                                        value="{{ old('product_brand') }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-trademark "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput8">الوصف</label>
                                                <div class="position-relative has-icon-left">
                                                    <textarea id="projectinput8" rows="3" class="form-control" name="product_desc">{{ old('product_desc') }}</textarea>
                                                    <div class="form-control-position">
                                                        <i class="la la-file-text"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="timesheetinput2">سعر البيع</label>
                                                <span style="color:red">*</span>
                                                <div class="position-relative has-icon-left">
                                                    <input type="number" id="timesheetinput2" class="form-control"
                                                        name="product_price" value="{{ old('product_price') }}" required>
                                                    <div class="form-control-position">
                                                        <i class="la la-money"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="timesheetinput2"> تتبع المنتج: </label>
                                            <div class="form-group pb-1">

                                                <label for="switcherySize10"
                                                    class="font-medium-2 text-bold-600 mr-1">نعم</label>
                                                <input type="checkbox" id="switcherySize10" name="product_track_stock"
                                                    class="switchery" value="1" data-size="lg" checked />
                                                <label for="switcherySize10"
                                                    class="font-medium-2 text-bold-600 ml-1">لا</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="timesheetinput2">نبهني عند وصول الكمية إلى أقل من</label>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="notify" class="form-control"
                                                        name="product_low_stock_thershold"
                                                        value="{{ old('product_low_stock_thershold') }}">
                                                    <div class="form-control-position">
                                                        <i class="la la-bell"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="projectinput8">ملاحظات داخلية</label>
                                        <div class="position-relative has-icon-left">
                                            <textarea id="projectinput8" rows="3" class="form-control" name="product_notes">{{ old('product_notes') }}</textarea>
                                            <div class="form-control-position">
                                                <i class="la la-sticky-note"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="">الفروع المسموح بالبيع منها:</label>
                                    <div class="form-group">
                                        @foreach ($branches as $branch)
                                            <input type="hidden" name="branch[{{ $branch->id }}][id]"
                                                value="{{ $branch->id }}">
                                            <input type="checkbox" name="branch[{{ $branch->id }}][selling]"
                                                id=""
                                                @if ($branch->id == 1) checked onclick="return false;" @endif>
                                            <label for="">{{ $branch->branch_name }}</label>
                                            <br />
                                        @endforeach
                                    </div>


                                    <button type="submit" class="btn btn-outline-primary btn-block"><i
                                            class="la la-check-square-o"></i> تسجيل</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        <!-- users view card data ends -->

        </section>
        <!-- users view ends -->
    </div>
    </div>



    @include('common.footer')
@endsection


@section('pageJs')



    <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>


    <script>
        function trackBool() {
            var checkBox = document.getElementById("switcherySize10");
            // Get the output text
            var notifyWhen = document.getElementById("notify");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                notifyWhen.disabled = false;
            } else {
                notifyWhen.disabled = true;
                notifyWhen.value = '';
            }
        }

        $(document).ready(function() {

            $('#switcherySize10').change(function(e) {
                trackBool();

            });

        });
    </script>

@endsection
