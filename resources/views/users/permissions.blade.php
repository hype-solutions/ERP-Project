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
            <li class="breadcrumb-item"><a href="{{route('users.list')}}">صلاحيات المستخدمين</a></li>
                <li class="breadcrumb-item active">تحكم
                </li>
              </ol>
            </div>
          </div>
        </div>

</div>
        <div class="content-body"><!-- users list start -->

{{-- <div class="col-xl-3 col-md-6 col-12">
            <div class="card border-teal border-lighten-2">
              <div class="text-center">

                <div class="card-body">
                  <h4 class="card-title">إضافة صلاحيات</h4>
                </div>
                <div class="text-center">
                  <button type="button" data-toggle="modal" data-target="#Add" class="btn  mb-1 btn-outline-linkedin btn-block"><span class="la la-plus font-medium-4"></span></button>


                  <div class="modal fade text-left" id="Add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel1">بيانات الصلاحيات</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="post" action="{{route('settings.permissions.adding')}}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="timesheetinput2">اسم الصلاحية</label>
                                                    <span style="color:red">*</span>
                                                    <div class="position-relative has-icon-left">
                                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="" name="permission_name" required>
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




   <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <h3>صلاحيات المستخدم <span style="color: green">{{$user->name}} </span></h3>
                  </div>
              </div>
              <form action="{{route('users.reSyncRolewithPermissions')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
              <div class="row">

                @foreach ($allPermissions as $key => $permission)
                  <div class="col-md-4">
                      <input type="checkbox" name="permission[{{$key}}][status]" @if($user->hasPermissionTo($permission->name)) checked @endif>
                      <input type="hidden" name="permission[{{$key}}][name]" value="{{$permission->name}}">
                    @lang('rolesAndPermissions.'.$permission->name)
                  </div>
                  @endforeach
                  <div class="col-md-12">
                    <button class="btn btn-block btn-primary" type="submit">حفظ</button>
                </div>

              </div>
            </form>

          </div>
        </div>
    </div>
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



    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<!-- END: Page JS-->
@endsection
