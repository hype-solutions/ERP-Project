@extends('layouts.erp')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">

    <!-- END: Page CSS-->
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">قائمة الإعدادات</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('settings.roles')}}">الصلاحيات</a></li>
                <li class="breadcrumb-item active">استعراض
                </li>
              </ol>
            </div>
          </div>
        </div>

</div>
        <div class="content-body"><!-- users list start -->


    <section id="simple-user-cards-with-border" class="row mt-2">

        @foreach ($roles as $role)
        <div class="col">
            <div class="card border-pink border-lighten-2">
              <div class="text-center">
                <div class="card-body">
                  <h4 class="card-title">{{$role}}</h4>
                  {{-- <h6 class="card-subtitle text-muted">Marketing Head</h6> --}}
                </div>
                <div class="text-center">
                  <a href="{{route('settings.permissions',$role)}}" class="btn btn-block mr-1 mb-1 btn-outline-facebook"><span class="la la-pencil"></span> تعديل الصلاحيات</a>
                  <a href="#" class="btn btn-block mr-1 mb-1 btn-outline-twitter"><span class="la la-member"></span>إضافة مستخدم لهذه الصلاحية</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        {{-- <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-teal border-lighten-2">
              <div class="text-center">

                <div class="card-body">
                  <h4 class="card-title">إضافة نوع مستخدم</h4>
                </div>
                <div class="text-center">
                  <button type="button" data-toggle="modal" data-target="#Add" class="btn  mb-1 btn-outline-linkedin btn-block"><span class="la la-plus font-medium-4"></span></button>


                  <div class="modal fade text-left" id="Add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel1">بيانات نوع المستخدم</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="post" action="{{route('settings.roles.adding')}}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="timesheetinput2">اسم النوع</label>
                                                    <span style="color:red">*</span>
                                                    <div class="position-relative has-icon-left">
                                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="" name="role_name" required>
                                                        <div class="form-control-position">
                                                            <i class="la la-user"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                                                <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> تسجيل</button>

                                            </form>
                            </div>
                        </div>

                        </div>
                    </div>

                </div>
              </div>
            </div>
          </div> --}}
      </section>





   </div>
</div>
</div>
<!-- END: Content-->
@include('common.footer')
@endsection


@section('pageJs')
<!-- BEGIN: Page Vendor JS-->


<!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<!-- END: Page JS-->
@endsection
