@extends('layouts.erp')

@section('pageCss')
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

    @if(session()->has('success'))
    @if(session()->get('success') == 'User Added' )
<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>تم بنجاح!</strong> إضافة مستخدم جديد
</div>
    @endif
@endif
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.list')}}">المستخدمين</a></li>
                <li class="breadcrumb-item active">إضافة مستخدم جديد
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
        <form class="form" method="post" action="{{route('users.adding')}}">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i> بيانات المستخدم</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">إسم الشخص</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: علي محمد" name="name" required>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">الإيميل</label>
                                <div class="position-relative has-icon-left">
                                    <input type="email" id="timesheetinput2" class="form-control" placeholder="مثال: name@company.com" name="email" required>
                                    <div class="form-control-position">
                                        <i class="la la-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">Username</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: ali123" name="username" required>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"><div class="form-group">
                                    <label for="timesheetinput2">كلمة السر</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="password" id="timesheetinput2" class="form-control"   name="password" required>
                                        <div class="form-control-position">
                                            <i class="la la-envelope"></i>
                                        </div>
                                    </div>
                                </div></div>
                                <div class="col-md-6"><div class="form-group">
                                    <label for="timesheetinput2">أعد كلمة السر</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="password" id="timesheetinput2" class="form-control"   name="password2" required>
                                        <div class="form-control-position">
                                            <i class="la la-envelope"></i>
                                        </div>
                                    </div>
                                </div></div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">الموبايل</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 01123456789" name="mobile">
                                    <div class="form-control-position">
                                        <i class="la la-mobile"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">نوع المستخدم</label>
                                <span style="color:red">*</span>
                                <select name="role" id="" class="form-control" required>
                                    <option>إختر...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>




                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="la la-check-square-o"></i> تسجيل</button>
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




<!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

    <script>
        $(document).ready(function () {

        $('#solo').click(function () {
            $('#company_extra').hide();
            $('#company_extra2').hide();

        });
        $('#company').click(function () {
            $('#company_extra').show();
            $('#company_extra2').show();

        });
    });
    </script>

 @endsection
