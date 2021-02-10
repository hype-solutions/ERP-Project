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
                <li class="breadcrumb-item"><a href="{{route('customers.list')}}">العملاء</a></li>
                <li class="breadcrumb-item active">ملف عميل
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/client.svg') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $customer[0]->customer_name }} </span>
            </h4>
          <span>رقم العميل:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $customer[0]->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('customers.view', $customer['0']->id) }}">استعراض الملف</a>
            <a class="dropdown-item" href="{{ route('customers.edit', $customer['0']->id) }}">تعديل الملف</a>
            <a class="dropdown-item" href="#">فاتورة جديد</a>
            <a class="dropdown-item" href="#">عرض سعر جديد</a>
            <div class="dropdown-divider"></div>
            <form action="{{route('customers.delete',$customer[0]->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف العميل</button>
            </form>
        </div>
    </div>
    <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التواصل مع العميل</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            @if ( isset($customer[0]->customer_mobile))
        <a class="dropdown-item" href="tel:{{$customer[0]->customer_mobile}}">اتصال بالموبايل</a>
            @else
            <button class="dropdown-item" href="#">اتصال بالموبايل</button>
            @endif
            @if ( isset($customer[0]->customer_phone))
        <a class="dropdown-item" href="tel:{{$customer[0]->customer_phone}}">اتصال بالتليفون</a>
            @else
            <button class="dropdown-item" href="#">اتصال بالتليفون</button>
            @endif
            <button class="dropdown-item" disabled>ارسال SMS <small style="color: red">غير متاحة</small></button>
            @if ( isset($customer[0]->customer_email))
        <a class="dropdown-item" href="mailto:{{$customer[0]->customer_email}}"> ارسال ايميل</a>
            @else
            <button class="dropdown-item" href="#"> ارسال ايميل</button>
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
                  <td>اسم العميل:</td>
                  <td>{{ $customer[0]->customer_name }}</td>
                </tr>
                <tr>
                    <td>نوع العميل:</td>
                    <td>
                        @if($customer[0]->customer_type == 'company')
                        تجاري
                        @else
                        فردي
                        @endif
                    </td>
                  </tr>
                @if($customer[0]->customer_type == 'company')
                <tr>
                  <td>الوظيفة:</td>
                  <td>
                      @if(isset($customer[0]->customer_title))
                    {{ $customer[0]->customer_title }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif
                </td>
                </tr>
                <tr>
                  <td>الشركة:</td>
                  <td>@if(isset($customer[0]->customer_company))
                    {{ $customer[0]->customer_company }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                @endif
                <tr>
                  <td>الموبايل:</td>
                  <td>{{ $customer[0]->customer_mobile }}</td>
                </tr>
                <tr>
                  <td>التليفون:</td>
                  <td>@if(isset($customer[0]->customer_phone))
                    {{ $customer[0]->customer_phone }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                <tr>
                   <td>الايميل:</td>
                   <td>@if(isset($customer[0]->customer_email))
                    {{ $customer[0]->customer_email }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                @if($customer[0]->customer_type == 'company')
                <tr>
                    <td>السجل التجاري:</td>
                    <td>
                        @if(isset($customer[0]->customer_commercial_registry))
                        {{ $customer[0]->customer_commercial_registry }}
                        @else
                        <small style="font-style: italic;color:red;">غير مسجل</small>
                        @endif
                    </td>
                 </tr>
                 <tr>
                    <td>البطاقة الضريبية:</td>
                    <td>
                        @if(isset($customer[0]->customer_tax_card))
                    {{ $customer[0]->customer_tax_card }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif
                </td>
                 </tr>
                @endif
                <tr>
                   <td>العنوان:</td>
                   <td> @if(isset($customer[0]->customer_address))
                    {{ $customer[0]->customer_address }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل </small>
                     @endif</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xl-6 col-lg-12 mb-1">
            <div class="form-group text-center">
                <!-- Floating Outline button with text -->
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">123</i><span>عدد فواتير الشراء</span></button>
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">321 جنية</i><span>إجمالي المبالغ من الفواتير</span></button>
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">456</i><span>عدد عروض الأسعار</span></button>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->
  <div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-content">
        <div class="card-body">

          <div class="col-12">
             <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> فاتورة جديدة</a>
              <h2 style="text-align: center">الفواتير</h2>
            <div class="table-responsive">
              <table class="table mb-0" id="reciepts">
                <thead>
                  <tr>
                    <th>رقم الفاتورة</th>
                    <th>التاريخ</th>
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
  <div class="col-md-6">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <div class="col-12">
            <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> عرض سعر جديد</a>
            <h2 style="text-align: center">عروض الأسعار</h2>
          <div class="table-responsive">
            <table class="table mb-0" id="quotations">
              <thead>
                <tr>
                  <th>رقم العرض</th>
                  <th>التاريخ</th>
                  <th>الإجمالي</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><div class="badge border-warning warning badge-border">
                        <a href="#" target="_blank" style="color: #ff9149"><span>123</span></a>
                    <i class="la la-barcode font-medium-2"></i>
                    </div></td>
                  <td>22/12/2020</td>
                  <td>500 جنية</td>
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
<div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-content">
          <div class="card-body">

            <div class="col-12">
                <h2 style="text-align: center">المبالغ المستحقة</h2>
              <div class="table-responsive">
                <table class="table mb-0" id="due">
                  <thead>
                    <tr>
                      <th>رقم الفاتورة</th>
                      <th>تاريخ الإستحقاق</th>
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
    <div class="col-md-6">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="col-12">
              <h2 style="text-align: center">الأصناف الأكثر طلبا</h2>
            <div class="table-responsive">
              <table class="table mb-0" id="most-ordered">
                <thead>
                  <tr>
                    <th>اسم الصنف</th>
                    <th>إجمالي الكمية التي اشتراها العميل</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>طفايات صغيرة</td>
                    <td>22 مرة</td>
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



    <!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script> --}}
<!-- END: Page JS-->
@endsection
