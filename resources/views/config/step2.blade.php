@extends('layouts.erp')
@section('title', 'الخطوة الثانية')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/icheck/icheck.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/icheck/custom.css') }}">
   <!-- BEGIN: Page CSS-->
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/login-register.min.css') }}">
   <!-- END: Page CSS-->
@endsection

@section('content')

    <!-- BEGIN: Content-->

      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">




            <section class="row flexbox-container">
  <div class="col-12 d-flex align-items-center justify-content-center">
    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
      <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
        <div class="card-header border-0 pb-0">
          <div class="card-title text-center">
            <img src="{{ asset('theme/app-assets/images/logo/logo_2.png') }}" alt="branding logo">
          </div>
          <div class="row">
            <div class="col-12 mt-1 text-center">
                <p>برنامج <code>Geture ERP</code> لإدارة الشركات</div>
        </div>
          <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>تثبيت و تشغيل البرنامج</span></h6>
        </div>
        <div class="card-content">
          <div class="card-body">
            <h5 class="text-center text-info" id="caption"></h5>
            <div class="progress">
                <div  id="bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width:100%"></div>
            </div>

          </div>
        </div>
        <div class="card-footer border-0">
            <div class="text-center" style="display: none" id="loginBtn">
                <p>اسم المستخدم: admin</p>
                <p>كلمة المرور: admin123</p>
                <a class="btn btn-success btn-block" href="{{route('login')}}">تسجيل الدخول</a>
            </div>
            <p class="float-sm-left text-center" id="newClient">عميل جديد؟  <a href="https://gesture-sys.com" target="_blank" class="card-link">تواصل معنا</a></p>
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

<script type="text/javascript">
    var i = 0;
    var progressBar = $("#bar");
    function countNumbers(){
        if(i < 100){
            i = i + 1;
            switch(i){
                case 1:
                $('#caption').text('جاري التحقق من متطلبات البرنامج...');
                break;
                case 25:
                $('#caption').text('جاري إنشاء أنواع المستخدمين...');
                break;
                case 50:
                $('#caption').text('جاري إنشاء الصلاحيات لكل نوع...');
                break;
                case 75:
                $('#caption').text('جاري إنشاء مستخدم مدير...');
                break;
                case 99:
                $('#caption').text('تم تثبيت البرنامج بنجاح...');
                $('#loginBtn').show();
                $('#bar').removeClass('progress-bar-animated');
                break;
            }
            progressBar.css("width", i + "%");
        }
        // Wait for sometime before running this script again
        setTimeout("countNumbers()", 200);
    }
    countNumbers();
    window.onload = function(){
    $('body').removeClass('vertical-compact-menu');
 }
</script>
   <!-- BEGIN: Page Vendor JS-->
   <script src="{{ asset('theme/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
   <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
   <!-- END: Page Vendor JS-->

       <!-- BEGIN: Page JS-->
       <script src="{{ asset('theme/app-assets/js/scripts/forms/form-login-register.min.js') }}"></script>
       <!-- END: Page JS-->
@endsection
