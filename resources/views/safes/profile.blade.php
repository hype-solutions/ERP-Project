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
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('safes.list')}}">الخزن</a></li>
                <li class="breadcrumb-item active">بيانات خزنة
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/safe.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $safe[0]->safe_name }} </span>
            </h4>
          <span>رقم الخزنة:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $safe[0]->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('safes.view', $safe['0']->id) }}">استعراض الخزنة</a>
            <a class="dropdown-item" href="{{ route('safes.view', $safe['0']->id) }}"> تحويل رصيد</a>
            @if($safe[0]->branch_id == 0)
            <div class="dropdown-divider"></div>
            <form action="{{route('safes.delete',$safe[0]->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا الخزنة نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف الخزنة</button>
            </form>
            @endif
        </div>
    </div>

    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        {{-- <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات الشراء: <span class="font-large-1 align-middle">125</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات عرض السعر: <span class="font-large-1 align-middle">534</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">إجمالي المبالغ من الفواتير: <span class="font-large-1 align-middle">256 جنية</span></h6>
            </div>
          </div> --}}
        <div class="row">
          <div class="col-12 col-md-4">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td>اسم الخزنة:</td>
                  <td>{{ $safe[0]->safe_name }}</td>
                </tr>

                <tr>
                  <td>مربوطة بفرع؟</td>
                  <td>
                      @if($safe[0]->branch_id > 0)
                    نعم
                      @else
                        لا
                      @endif
                </td>
                </tr>
                @if($safe[0]->branch_id > 0)
                <tr>
                  <td>الفرع المربوط:</td>
                <td><a href="{{route('branches.view',$branch[0]->id)}}" target="_blank">{{ $branch[0]->branch_name }}</a></td>
                </tr>
                @endif


              </tbody>
            </table>
          </div>
          <div class="col-xl-6 col-lg-12 mb-1">
            <div class="form-group text-center">
                <!-- Floating Outline button with text -->
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">{{ $safe[0]->safe_balance }} جنية</i><span>رصيد الخزنة</span></button>
             </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">

            <div class="col-12">
                <h2 style="text-align: center"> عمليات الخزنة</h2>
              <div class="table-responsive">
                <table class="table mb-0" id="due">
                  <thead>
                    <tr>
                      <th>رقم العميلة</th>
                      <th>تاريخ العميلة</th>
                      <th> نوع العميلة</th>
                      <th>الإجمالي</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div class="badge border-info info badge-border">
                          <a href="#" target="_blank" style="color: #1e9ff2"><span>123</span></a>
                      <i class="la la-barcode font-medium-2"></i>
                      </div></td>
                      <td>22/12/2020</td>
                      <td>تحويل من خزنة xxxx</td>
                      <td>450 جنية</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

  </div>

  <!-- users view card details ends -->

</section>
<!-- users view ends -->
        </div>
      </div>



@include('common.footer')
@endsection


@section('pageJs')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<!-- END: Page Vendor JS-->
<script>

$("#reciepts").DataTable();
$("#quotations").DataTable();
$("#due").DataTable();
$("#most-ordered").DataTable();
</script>



<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script> --}}
<!-- END: Page JS-->
@endsection
