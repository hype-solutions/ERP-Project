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
                <li class="breadcrumb-item"><a href="{{route('products.list')}}">المنتجات</a></li>
                <li class="breadcrumb-item active">ملف منتج
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
          <h4 class="media-heading"><span class="users-view-name">{{ $product[0]->product_name }} </span>
            </h4>
          <span>رقم المنتج:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $product[0]->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-2 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم في المنتج</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('products.view', $product['0']->id) }}">استعراض المنتج</a>
            <a class="dropdown-item" href="{{ route('products.edit', $product['0']->id) }}">تعديل المنتج</a>
            <a class="dropdown-item" href="#">طباعه BARCODE</a>
            <div class="dropdown-divider"></div>
            <form action="{{route('products.delete',$product[0]->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف المنتج</button>
            </form>
        </div>
    </div>
    <div class="btn-group mr-1 mb-1"  style="width: 100%;">
        <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التحكم في المخزون</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{route('products.addQty',$product[0]->id)}}">أضف كمية يدويا</a>
            <a class="dropdown-item" href="#">أمر شراء جديد</a>
            <a class="dropdown-item" href="{{route('products.transfer',$product[0]->id)}}">تحويل كميات بين الفروع</a>

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
                  <td>اسم المنتج:</td>
                  <td>{{ $product[0]->product_name }}</td>
                </tr>

                <tr>
                  <td>كود المنتج:</td>
                  <td>@if(isset($product[0]->product_code))
                    {{ $product[0]->product_code }}
                    @else
                    <small style="font-style: italic;color:red;">غير مسجل</small>
                    @endif</td>
                </tr>
                <tr>
                    <td> الوصف:</td>
                    <td>@if(isset($product[0]->product_code))
                      {{ $product[0]->product_code }}
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                <tr>
                    <td> الفئة: </td>
                    <td>@if(isset($product[0]->product_category))
                      {{ $product[0]->product_category }}
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                  <tr>
                    <td> الفئة الفرعية:</td>
                    <td>@if(isset($product[0]->product_sub_category))
                      {{ $product[0]->product_sub_category }}
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                  <tr>
                    <td>  سعر البيع:</td>
                    <td>@if(isset($product[0]->product_price))
                      {{ $product[0]->product_price }}
                      جنية
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                  <tr>
                    <td> كمية المخزون:</td>
                    <td>
                      {{ $product[0]->product_total_in - $product[0]->product_total_out }}
                      </td>
                  </tr>
                  <tr>
                    <td> الماركة:</td>
                    <td>@if(isset($product[0]->product_brand))
                      {{ $product[0]->product_brand }}
                      @else
                      <small style="font-style: italic;color:red;">غير مسجل</small>
                      @endif</td>
                  </tr>
                  <tr>
                    <td> تتبع المخزون:</td>
                    <td>@if(($product[0]->product_track_stock == 1))
                      نعم (تنبيه عند الوصل الى {{$product[0]->product_low_stock_thershold}} قطع)
                      @else
                      لا
                      @endif</td>
                  </tr>




                <tr>
                    <td>الملاحظات الداخليه:</td>
                    <td> @if(isset($product[0]->product_notes))
                     {{ $product[0]->product_notes }}
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
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">25 جنية</i><span>متوسط سعر التكلفة</span></button>
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">3545</i><span>إجمالي القطع المباعة</span></button>
                <button type="button" class="btn btn-float btn-outline-cyan"><i class="">{{ $product[0]->product_total_in - $product[0]->product_total_out }}</i><span>كمية المخزون</span></button>
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
                <a href="{{route('products.transfer',$product[0]->id)}}" class="btn btn-social mb-1 mr-1 btn-sm btn-primary" style="float: left"><span class="la la-arrows-h"></span> تحويل بين الفروع</a>
                  <h2 style="text-align: center"> المخزون</h2>
                <div class="table-responsive">
                  <table class="table mb-0" id="reciepts">
                    <thead>
                      <tr>
                        <th>كود الفرع</th>
                        <th> الفرع</th>
                        <th>الكمية</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $key => $branch)
                        <tr>
                            <td><div class="badge border-info info badge-border">
                                <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$branch->branch[0]->id}}</span></a>
                            </div></td>
                        <td>{{$branch->branch[0]->branch_name}}</td>
                        <td>{{$branch->amount}} قطعة</td>
                      </tr>
                      @endforeach
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
                      <h2 style="text-align: center"> الموردين</h2>
                    <div class="table-responsive">
                      <table class="table mb-0" id="suppliers">
                        <thead>
                          <tr>
                            <th> المورد</th>
                            <th>الكمية المورده</th>
                            <th>اخر سعر</th>
                          </tr>
                        </thead>
                        <tbody>
                            <td> شركة بقاريا</td>
                            <td>200</td>
                            <td>10 جنية</td>
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
    <div class="col-md-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">

            <div class="col-12">
                <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span>  عملية جديدة</a>
                <h2 style="text-align: center"> حركة المخزون</h2>
              <div class="table-responsive">
                <table class="table mb-0" id="due">
                  <thead>
                    <tr>
                      <th> العملية</th>
                      <th> الوقت</th>
                      <th> حركة</th>
                      <th>المخزون بعد</th>
                      <th>الحالة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>

                      <td><div class="badge border-success info badge-border">
                          <a href="#" target="_blank" style="color: #28d094"><span>
                            فاتورة (#00001)
                        </span></a>
                      </div></td>
                      <td>22/11/2020 22:52</td>
                      <td><b><font color="red">-</font></b> 22</td>
                      <td>900</td>
                      <td>

                        <div class="badge badge-success">
                            <i class="la la-money font-medium-2"></i>
                                <span>مدفوع</span>
                            </div>
                      </td>
                    </tr>
                    <tr>

                        <td><div class="badge border-info info badge-border">
                            <a href="#" target="_blank" style="color: #1e9ff2"><span>
                                أمر شرا (#4)
                            </span></a>

                        </div></td>
                        <td>22/11/2020 22:51</td>
                        <td><b><font color="green">+</font></b> 10</td>
                        <td>2000</td>
                        <td>

                                <div class="badge badge-danger">
                                    <i class="la la-truck font-medium-2"></i>
                                    <span>لم يستلم</span>
                                </div>
                        </td>
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
$("#suppliers").DataTable();
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
