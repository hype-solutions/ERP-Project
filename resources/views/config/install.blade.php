@extends('layouts.erp')
@section('title', 'الخطوة الأولى')

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
            <form class="form-horizontal" id="verificationForm">
              <fieldset class="form-group position-relative has-icon-left">
                <input type="text" class="form-control" id="activation_code" placeholder="كود تشغيل البرنامج الخاص بك" autocomplete="off" required>
                <div class="form-control-position">
                  <i class="la la-key"></i>
                </div>
              </fieldset>
              <button type="button" onclick="return verify()" class="btn btn-outline-info btn-lg btn-block">
                <span id="btnText"><i class="ft-unlock"></i> تشغيل البرنامج</span>
                <span id="loading" style="display: none"><i class="la la-spinner spinner"></i> جاري التحقق</span>
            </button>

            </form>
            <h3 class="text-success text-center" id="verified" style="display: none">تم التحقق</h3>
            <h3 class="text-danger text-center"  id="notVerified" style="display: none">كود خطأ, حاول مرة أخرى</h3>
            <h4 class="text-warning text-center"  id="alreadyInstalled" style="display: none">
                هذا الكود مستخدم بالفعل على نسخة أخرى, للإستفسارات
                <br/>
                <a href="https://gesture-sys.com" target="_blank" class="card-link">تواصل معنا</a>
            </h4>
            <h3 class="text-danger text-center"  id="tooManyAttempts" style="display: none">محاولات كثيرة خاطئة, برجاء المحاولة لاحقا</h3>

            <div id="ownerData"></div>

          </div>
        </div>
        <div class="card-footer border-0">
            <form id="continue" style="display: none" action="{{route('config.install.step2')}}" method="post">
                @csrf
                <input type="hidden" name="versionData" id="versionData" />
                <div class="row">
                    <div class="col text-center">
                        <button class="btn btn-success">إضغط هنا للإستمرار</button>
                    </div>
                </div>
            </form>
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

<script>

$("#verificationForm").submit(function (e) {
    e.preventDefault();
    verify();
});



function verify(){
    var code = $('#activation_code').val();
    if(!code){
        alert('من فضلك أدخل الكود!');
    }else{
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            license: code,
        };
        var type = "POST";
        var ajaxurl = "{{route('config.install.verify')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                $("#btnText").hide();
                $("#loading").show();
            },
            success: function (data) {
                $("#loading").hide();
                if(data.verfied == 1){
                    $("#tooManyAttempts").hide();
                    if(data.alreadyInstalled == 1){
                    $("#btnText").show();
                    $("#notVerified").hide();
                    $("#alreadyInstalled").show();
                    }else{
                    $("#alreadyInstalled").hide();
                    $("#notVerified").hide();
                    $("#verificationForm").hide();
                    $("#newClient").hide();
                    $("#verified").show();
                    var renewOrNot = '';
                    if(data.online == 1){renewOrNot = '<tr><th>تاريخ التجديد القادم</th><td>'+data.nextRenewal+'</td></tr>'}
                    $("#ownerData").html('<table class="table"><tr><th>اسم المالك</th><td>'+data.owner+'</td></tr><tr><th>تاريخ الشراء</th><td>'+data.purchaseDate+'</td></tr>'+renewOrNot+'</table>');
                    $("#continue").show();

                        $('#versionData').val(JSON.stringify(data));

                    }
                }else{
                    $("#btnText").show();
                    $("#notVerified").show();
                }
            },
            error: function (data) {
                console.log(data);
                $("#notVerified").hide();
                $("#loading").hide();
                $("#btnText").show();
                $("#tooManyAttempts").show();

            }
        });
    }
}
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
