@extends('layouts.erp')
@section('title', 'قائمة جهات المصاريف المختصة')

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
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">قائمة جهات المصاريف المختصة</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('outs.list')}}">المصاريف</a></li>
                <li class="breadcrumb-item active">استعراض جهات المصاريف
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
          <button  data-toggle="modal" data-target="#default" class="btn btn-outline-success block btn-lg" >
                إضافه جهات مصاريف
            </button>
            <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel1">جهه جديدة</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" method="post" action="{{route('outs.entities.adding')}}">
                                @csrf
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="timesheetinput2">اسم الجهه</label>
                                                <span style="color:red">*</span>
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="" name="entity_name" required>
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
      </div>
  <div class="content-body"><!-- users list start -->
<section class="users-list-wrapper">

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
        @if(session()->get('success') == 'in Deleted' )
    <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>تم بنجاح!</strong> حذف بيانات فرع
    </div>

        @endif
    @endif
{{-- <div class="users-list-filter px-1">
  <form>
      <div class="row border border-light rounded py-2 mb-2">
          <div class="col-12 col-sm-6 col-lg-3">
              <label for="users-list-verified">Verified</label>
              <fieldset class="form-group">
                  <select class="form-control" id="users-list-verified">
                      <option value="">Any</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                  </select>
              </fieldset>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
              <label for="users-list-role">Role</label>
              <fieldset class="form-group">
                  <select class="form-control" id="users-list-role">
                      <option value="">Any</option>
                      <option value="User">User</option>
                      <option value="Staff">Staff</option>
                  </select>
              </fieldset>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
              <label for="users-list-status">Status</label>
              <fieldset class="form-group">
                  <select class="form-control" id="users-list-status">
                      <option value="">Any</option>
                      <option value="Active">Active</option>
                      <option value="Close">Close</option>
                      <option value="Banned">Banned</option>
                  </select>
              </fieldset>
          </div>
          <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
              <button class="btn btn-block btn-primary glow">Show</button>
          </div>
      </div>
  </form>
</div> --}}
<div class="users-list-table">
  <div class="card">
      <div class="card-content">
          <div class="card-body">
              <!-- datatable start -->
              <div class="table-responsive">
                <table id="users-list-datatable" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الجهة</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entities as $entity)
                        <tr>
                            <td>{{ $entity->id }}</td>
                            <td>{{ $entity->entity_name }}</td>
                            <td>
                                <button data-toggle="modal" data-target="#edit_entity{{ $entity->id }}" class="btn btn-warning btn-sm"><i class="la la-pencil-square-o"></i> تعديل</button>
                                <a href="{{ route('outs.entities.deleting', $entity->id) }}" class="btn btn-danger btn-sm"><i class="la la-trash"></i> حذف</a>

                                <div class="modal fade text-left" id="edit_entity{{ $entity->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1"> تعديل</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="post" action="{{route('outs.entities.editing', $entity->id)}}">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="timesheetinput2">الجهه</label>
                                                                    <br/>
                                                                    <input type="text" class="form-control" name="entity_name" value="{{ $entity->entity_name }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                                                        <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> تسجيل</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                </table>
              </div>
              <!-- datatable ends -->
          </div>
      </div>
  </div>
</div>
</section>
<!-- users list ends -->
  </div>
</div>
</div>
<!-- END: Content-->
@include('common.footer')
@endsection


@section('pageJs')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
<!-- END: Page JS-->
@endsection
