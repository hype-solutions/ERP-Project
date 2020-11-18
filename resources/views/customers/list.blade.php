@extends('layouts.erp')

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
          <h3 class="content-header-title mb-0">قائمة العملاء</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('customers.list')}}">العملاء</a></li>
                <li class="breadcrumb-item active">استعراض
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
            <button type="button" class="btn btn-outline-success block btn-lg" data-toggle="modal" data-target="#large">
                إضافه عميل جديد
            </button>
            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">إضافة عميل جديد</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="card-text">
                                            {{-- <p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p> --}}
                                        </div>
                                    <form class="form" method="post" action="{{route('customer.add')}}">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> بيانات العميل</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="timesheetinput2">اسم العميل</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: علي محمد" name="customer_name" required>
                                                                <div class="form-control-position">
                                                                    <i class="la la-user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="timesheetinput2">الوظيفة</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: مدير المشتريات" name="customer_title">
                                                                <div class="form-control-position">
                                                                    <i class="la la-briefcase"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="timesheetinput2">الشركة</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="الشركة التي يعمل لحسابها" name="customer_company">
                                                                <div class="form-control-position">
                                                                    <i class="la la-home"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="timesheetinput2">الإيميل</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="email" id="timesheetinput2" class="form-control" placeholder="مثال: name@company.com" name="customer_email">
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
                                                            <label for="timesheetinput2">الموبايل</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 01123456789" name="customer_mobile" required>
                                                                <div class="form-control-position">
                                                                    <i class="la la-mobile"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="timesheetinput2">التليفون</label>
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 0223456789" name="customer_phone">
                                                                <div class="form-control-position">
                                                                    <i class="la la-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput8">العنوان</label>
                                                    <div class="position-relative has-icon-left">
                                                    <textarea id="projectinput8" rows="3" class="form-control" name="customer_address" placeholder="عنوان الشخص أو عنوان الشركة إن وجد"></textarea>
                                                    <div class="form-control-position">
                                                        <i class="la la-map"></i>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> تسجيل</button>
                        </div>
                    </form>
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
        @if(session()->get('success') == 'Customer Added' )
    <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>تم بنجاح!</strong> إضافة عميل جديد
    </div>
        @else
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>تم بنجاح!</strong> حذف بيانات عميل
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
                            <th>رقم العميل</th>
                            <th>بيانات العميل</th>
                            <th>الموبايل</th>
                            <th>التليفون</th>
                            <th>الإيميل</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td><li class="la la-user"></li>
                                {{ $customer->customer_name }}
                                <br/>
                                <li class="la la-briefcase"></li>
                                {{ $customer->customer_title }}
                                <br/>
                                <li class="la la-home"></li>
                                {{ $customer->customer_company }}
                            </td>
                            <td><li class="la la-mobile"></li> {{ $customer->customer_mobile }}</td>
                            <td><li class="la la-phone"></li> {{ $customer->customer_phone }}</td>
                            <td><li class="la la-envelope"></li> {{ $customer->customer_email }}</td>
                            <td>
                                <a href="{{ route('customer.view', $customer->id) }}" class="btn btn-info btn-sm"><i class="la la-folder-open"></i> استعراض</a>
                                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary btn-sm"><i class="la la-pencil-square-o"></i> تعديل</a>
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
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
<!-- END: Page JS-->
@endsection
