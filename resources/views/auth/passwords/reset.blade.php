@extends('layouts.erp')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/icheck/custom.css') }}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
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
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <div class="p-1"><img
                                            src="{{ asset('theme/app-assets/images/logo/logo_2.png') }}"
                                            alt="branding logo"></div>
                                </div>
                                <h3 class="card-subtitle line-on-side text-muted text-center pt-2"><span>ERP</span>
                                </h3>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
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
                                    @if (session('status'))
                                            <div class="alert alert-icon-left alert-success alert-dismissible mb-2"
                                                role="alert">
                                                <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong>{{ session('status') }}</strong>

                                            </div>

                                        @endif
                                    <form method="POST" class="form-horizontal form-simple"
                                        action="{{ route('password.email') }}">
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left mb-0">
                                            <input type="text" name="email" class="form-control" id="user-name"
                                                placeholder="البريد الإلكتروني" value="{{ old('email') }}" required
                                                autofocus>
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="كلمه السر" required autocomplete="new-password">
                                            <div class="form-control-position">
                                              <i class="la la-key"></i>
                                            </div>
                                          </fieldset>
                                          <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password_confirmation" class="form-control" id="password" placeholder="تأكيد كلمة المرور" required autocomplete="new-password">
                                            <div class="form-control-position">
                                              <i class="la la-key"></i>
                                            </div>
                                          </fieldset>

                                        <button type="submit" class="btn btn-success btn-block"><i
                                                class="ft-unlock"></i> تسجيل كلمة المرور الجديدة</button>
                                    </form>
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
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('theme/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/forms/form-login-register.min.js') }}"></script>
    <!-- END: Page JS-->
@endsection
