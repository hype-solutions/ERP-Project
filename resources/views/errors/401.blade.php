@extends('layouts.erp')
@section('title', '401')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/icheck/custom.css') }}">
   <!-- BEGIN: Page CSS-->
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/error.min.css') }}">
   <!-- END: Page CSS-->
@endsection

@section('content')

    <!-- BEGIN: Content-->

      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">


            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 p-0">
                        <div class="card-header bg-transparent border-0">
                            <h2 class="error-code text-center mb-2">401</h2>
                            <h3 class="text-uppercase text-center">غير مصرح لك بتنفيذ هذه العملية!</h3>
                        </div>
                        <div class="card-content">

                            <div class="row py-2">
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <a href="{{route('home')}}" class="btn btn-primary btn-block"><i class="ft-home"></i> واجهة البرنامح</a>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 mb-1">
                                    <a href="{{url()->previous()}}" class="btn btn-danger btn-block"><i class="ft-arrow-left"></i>  عودة للشاشة السابة</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>



        </div>
      </div>

    <!-- END: Content-->

@endsection

@section('pageJs')
<script>
window.onload = function(){
    $('body').removeClass('vertical-compact-menu');
 }

</script>
   <!-- BEGIN: Page Vendor JS-->
   <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
   <!-- END: Page Vendor JS-->

       <!-- BEGIN: Page JS-->
       <script src="{{ asset('theme/app-assets/js/scripts/forms/form-login-register.min.js') }}"></script>
       <!-- END: Page JS-->
@endsection
