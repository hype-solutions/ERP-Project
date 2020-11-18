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
                <li class="breadcrumb-item active">تعديل ملف
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
            <a class="dropdown-item" href="{{ route('customer.view', $customer['0']->id) }}">استعراض الملف</a>
            <a class="dropdown-item" href="{{ route('customer.edit', $customer['0']->id) }}">تعديل الملف</a>
            <a class="dropdown-item" href="#">فاتورة جديد</a>
            <a class="dropdown-item" href="#">عرض سعر جديد</a>
            <div class="dropdown-divider"></div>
            <form action="{{route('customer.delete',$customer[0]->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل نهائيا و جميع تفاصيله من البرنامج')">
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
          <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="card-text">
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
                            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>تم بنجاح!</strong> تحديث ملف العميل
                            </div>
                            @endif                        </div>
                    <form class="form" method="post" action="{{route('customer.update',$customer['0']->id)}}">
                            @csrf
                            @method('patch')
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> بيانات العميل</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="timesheetinput2">اسم العميل</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: علي محمد" name="customer_name" value="{{$customer[0]->customer_name}}" required>
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
                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: مدير المشتريات" name="customer_title" value="{{$customer[0]->customer_title}}">
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
                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="الشركة التي يعمل لحسابها" name="customer_company"  value="{{$customer[0]->customer_company}}">
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
                                                <input type="email" id="timesheetinput2" class="form-control" placeholder="مثال: name@company.com" name="customer_email"  value="{{$customer[0]->customer_email}}">
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
                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 01123456789" name="customer_mobile" value="{{$customer[0]->customer_mobile}}" required>
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
                                                <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 0223456789" name="customer_phone" value="{{$customer[0]->customer_phone}}">
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
                                    <textarea id="projectinput8" rows="3" class="form-control" name="customer_address" placeholder="عنوان الشخص أو عنوان الشركة إن وجد">{{$customer[0]->customer_address}}</textarea>
                                    <div class="form-control-position">
                                        <i class="la la-map"></i>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
								<button type="button" class="btn btn-warning mr-1">
									<i class="ft-x"></i> الغاء
								</button>
								<button type="submit" class="btn btn-primary">
									<i class="la la-check-square-o"></i> حفظ
								</button>
							</div>

                    </div>
                </div>
            </div>
          </div>

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
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

 @endsection
