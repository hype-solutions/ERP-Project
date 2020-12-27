@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/switch.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-switch.min.css') }}">
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
                            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>تم بنجاح!</strong> تحديث ملف المنتج
                            </div>
                            @endif
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('products.list')}}">المنتجات</a></li>
                <li class="breadcrumb-item active">تعديل ملف
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/product.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $product->product_name }} </span>
            </h4>
          <span>رقم المنتج:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $product->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-2 mb-2">
        <div class="btn-group mr-1 mb-1">
         <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم في المنتج</button>
         <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
             <a class="dropdown-item" href="{{ route('products.view', $product->id) }}">استعراض المنتج</a>
             <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">تعديل المنتج</a>
             <a class="dropdown-item" href="#">طباعه BARCODE</a>
             <div class="dropdown-divider"></div>
             <form action="{{route('products.delete',$product->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج نهائيا و جميع تفاصيله من البرنامج')">
                 @csrf
                 @method('delete')
             <button class="dropdown-item btn-danger btn" type="submit">حذف المنتج</button>
             </form>
         </div>
     </div>
     <div class="btn-group mr-1 mb-1"  style="width: 100%;">
         <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التحكم في المخزون</button>
         <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
             <a class="dropdown-item" href="{{route('products.addQty',$product->id)}}">أضف كمية يدويا</a>
             <a class="dropdown-item" href="{{route('purchasesorders.add')}}">أمر شراء جديد</a>
             <a class="dropdown-item" href="{{route('products.transfer',$product->id)}}">تحويل كميات بين الفروع</a>

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

                    <form class="form" method="post" action="{{route('products.update',$product->id)}}">
                            @csrf
                            @method('patch')
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> بيانات المنتج</h4>

                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="timesheetinput2">اسم المنتج</label>
                                            <span style="color:red">*</span>
                                            <div class="position-relative has-icon-left">
                                            <input type="text" id="timesheetinput2" class="form-control" name="product_name" value="{{$product->product_name}}" required>
                                                <div class="form-control-position">
                                                    <i class="la la-pencil-square"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="timesheetinput2">كود المنتج</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="timesheetinput2" class="form-control" name="product_code" value="{{$product->product_code}}">
                                                <div class="form-control-position">
                                                    <i class="la la-barcode"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-bold-600 font-medium-2">
                                     الفئة
                                    </div>
                                    <select class="select2-rtl form-control" data-placeholder="إختر الفئة..." name="product_category">
                                        <option value="{{$product->product_category}}">تغيير الفئة...</option>
                                        <option value="HI">الطفايات</option>
                                    </select>
                                  </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="text-bold-600 font-medium-2">
                                              الفئة الفرعية
                                            </div>
                                            <select class="select2-rtl form-control"  name="product_sub_category">
                                                <option value="{{$product->product_code}}">تغيير الفئة الفرعية...</option>
                                                <option value="NV">Nevada</option>
                                                <option value="OR">Oregon</option>
                                                <option value="WA">Washington</option>

                                            </select>
                                          </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="timesheetinput2">الماركة</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: بفاريا" name="product_brand"  value="{{$product->product_brand}}">
                                                        <div class="form-control-position">
                                                            <i class="la la-trademark "></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput8">الوصف</label>
                                            <div class="position-relative has-icon-left">
                                            <textarea id="projectinput8" rows="3" class="form-control" name="product_desc">{{$product->product_desc}}</textarea>
                                            <div class="form-control-position">
                                                <i class="la la-file-text"></i>
                                            </div>
                                            </div>
                                        </div>
                                            </div>


                                </div>
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="timesheetinput2">سعر البيع</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="number" id="timesheetinput2" class="form-control"  name="product_price"  value="{{$product->product_price}}" required>
                                                <div class="form-control-position">
                                                    <i class="la la-money"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="timesheetinput2"> تتبع المنتج: </label>
                                        <div class="form-group pb-1">

                                            <label for="switcherySize10" class="font-medium-2 text-bold-600 mr-1">نعم</label>
                                            <input type="checkbox" id="switcherySize10" name="product_track_stock" class="switchery" value="1" data-size="lg"  value="{{$product->product_track_stock}}" checked />
                                            <label for="switcherySize10" class="font-medium-2 text-bold-600 ml-1">لا</label>
                                          </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="timesheetinput2">نبهني عند وصول الكمية إلى أقل من</label>
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="notify" class="form-control"  name="product_low_stock_thershold"  value="{{$product->product_low_stock_thershold}}">
                                                <div class="form-control-position">
                                                    <i class="la la-bell"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="form-group">
                                    <label for="projectinput8">ملاحظات داخلية</label>
                                    <div class="position-relative has-icon-left">
                                    <textarea id="projectinput8" rows="3" class="form-control" name="product_notes">{{$product->product_notes}}</textarea>
                                    <div class="form-control-position">
                                        <i class="la la-sticky-note"></i>
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


<script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>

<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
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
     <script>
        function trackBool() {
          var checkBox = document.getElementById("switcherySize10");
          // Get the output text
          var notifyWhen = document.getElementById("notify");

          // If the checkbox is checked, display the output text
          if (checkBox.checked == true){
            notifyWhen.disabled  = false;
          } else {
            notifyWhen.disabled  = true;
            notifyWhen.value  = '';
          }
        }

                $(document).ready(function () {

                $('#switcherySize10').change(function (e) {
                    trackBool();

                });

            });
            </script>

 @endsection
