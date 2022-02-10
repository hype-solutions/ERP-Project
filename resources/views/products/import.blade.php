@extends('layouts.erp')
@section('title', 'إضافة منتج')

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
        href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

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
                                    <li class="breadcrumb-item active">رفع ملف
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
                            <form class="form" method="post" action="{{ route('products.importing') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> رفع ملف Excel لمنتجات و فئات و كميات</h4>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="timesheetinput2">اختر الملف</label>
                                                <span style="color:red">*</span>
                                                <div class="position-relative has-icon-left">
                                                    <input type="file" id="timesheetinput2" class="form-control"
                                                        name="importer" required>
                                                    <div class="form-control-position">
                                                        <i class="la la-pencil-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                </div>


                                <button type="submit" class="btn btn-outline-primary btn-block"><i
                                        class="la la-check-square-o"></i> رفع</button>
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
