@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">





{{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/bootstrap.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/fonts/fontawesome/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/OverlayScrollbars.css') }}">

<style>
	.avatar {
  vertical-align: middle;
  width: 35px;
  height: 35px;
  border-radius: 50%;
}
.bg-default, .btn-default{
	background-color: #f2f3f8;
}
.btn-error{
	color: #ef5f5f;
}
</style>

<!-- END: Page CSS-->
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')

<div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
                <div class="col-12 col-sm-7">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                          <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                        <li class="breadcrumb-item"><a href="{{route('branches.list')}}">الفروع</a></li>
                            <li class="breadcrumb-item active">إضافة فرع جديد
                            </li>
                          </ol>
                        </div>
                      </div>

                </div>


        </div>
        <div class="content-body">
            <section class="section-content padding-y-sm bg-default ">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 card padding-y-sm card ">
                        <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="pill" href="#nav-tab-card">
                        <i class="fa fa-tags"></i> جميع الفئات</a></li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
                        <i class="fa fa-tags "></i>  الفئة الأولى</a></li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                        <i class="fa fa-tags "></i>  الفئة الثانية</a></li>
                         <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                        <i class="fa fa-tags "></i>  الفئة الثالثة</a></li>
                        <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                        <i class="fa fa-tags "></i>  الفئة الرابعة</a></li>

                </ul>
                <span   id="items">
                <div class="row">
                    @foreach ($products as $item)
                <div class="col-md-3">
                    <figure class="card card-product">
                        <span class="badge-new"> NEW </span>
                        <div class="img-wrap">
                            <img src="{{asset('theme/pos/images/items/noImg.jpg')}}">
                            <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> نظرة سريعة</a>
                        </div>
                        <figcaption class="info-wrap">
                            <a href="#" class="title">{{$item->product_name}}</a>
                            <div class="action-wrap">
                                <a href="#" class="btn btn-primary btn-sm float-right"> <i class="fa fa-cart-plus"></i> إضافة </a>
                                <div class="price-wrap h5">
                                    <span class="price-new">{{$item->product_price}} ج.م</span>
                                </div> <!-- price-wrap.// -->
                            </div> <!-- action-wrap -->
                        </figcaption>
                    </figure> <!-- card // -->
                </div> <!-- col // -->
                @endforeach
                </div> <!-- row.// -->

                </span>
                    </div>
                    <div class="col-md-4">
                <div class="card">
                    <span id="cart">
                <table class="table table-hover shopping-cart-wrap">
                <thead class="text-muted">
                <tr>
                  <th scope="col">المنتج</th>
                  <th scope="col" width="100">الكمبة</th>
                  <th scope="col" width="100">السعر</th>
                  <th scope="col" class="text-right" width="150">حذف</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                <figure class="media">
                    <div class="img-wrap"><img src="{{asset('theme/pos/images/items/noImg.jpg')}}" class="img-thumbnail img-xs"></div>
                    <figcaption class="media-body">
                        <h6 class="title text-truncate">Product name </h6>
                    </figcaption>
                </figure>
                    </td>
                    <td class="text-center">
                        <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-minus"></i></button>
                                                                                        <button type="button" class="m-btn btn btn-default" disabled>3</button>
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-plus"></i></button>
                                                                                    </div>
                    </td>
                    <td>
                        <div class="price-wrap">
                            <var class="price">$145</var>
                        </div> <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                    <a href="" class="btn btn-outline-danger"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                <figure class="media">
                    <div class="img-wrap"><img src="{{asset('theme/pos/images/items/noImg.jpg')}}" class="img-thumbnail img-xs"></div>
                    <figcaption class="media-body">
                        <h6 class="title text-truncate">Product name  </h6>
                    </figcaption>
                </figure>
                    </td>
                    <td class="text-center">
                                <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-minus"></i></button>
                                                                                        <button type="button" class="m-btn btn btn-default" disabled>1</button>
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-plus"></i></button>
                                                                                    </div>
                    </td>
                    <td>
                        <div class="price-wrap">
                            <var class="price">$35</var>
                        </div> <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                    <a href="" class="btn btn-outline-danger btn-round"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                <figure class="media">
                    <div class="img-wrap"><img src="{{asset('theme/pos/images/items/noImg.jpg')}}" class="img-thumbnail img-xs"></div>
                    <figcaption class="media-body">
                        <h6 class="title text-truncate">Product name  </h6>
                    </figcaption>
                </figure>
                    </td>
                    <td class="text-center">
                                <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-minus"></i></button>
                                                                                        <button type="button" class="m-btn btn btn-default" disabled>5</button>
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-plus"></i></button>
                                                                                    </div>
                    </td>
                    <td>
                        <div class="price-wrap">
                            <var class="price">$45</var>
                        </div> <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                        <a href="" class="btn btn-outline-danger btn-round"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                <figure class="media">
                    <div class="img-wrap"><img src="{{asset('theme/pos/images/items/noImg.jpg')}}" class="img-thumbnail img-xs"></div>
                    <figcaption class="media-body">
                        <h6 class="title text-truncate">Product name  </h6>
                    </figcaption>
                </figure>
                    </td>
                    <td class="text-center">
                                <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-minus"></i></button>
                                                                                        <button type="button" class="m-btn btn btn-default" disabled>2</button>
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-plus"></i></button>
                                                                                    </div>
                    </td>
                    <td>
                        <div class="price-wrap">
                            <var class="price">$45</var>
                        </div> <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                        <a href="" class="btn btn-outline-danger btn-round"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>
                <figure class="media">
                    <div class="img-wrap"><img src="{{asset('theme/pos/images/items/noImg.jpg')}}" class="img-thumbnail img-xs"></div>
                    <figcaption class="media-body">
                        <h6 class="title text-truncate">Product name  </h6>
                    </figcaption>
                </figure>
                    </td>
                    <td class="text-center">
                                <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-minus"></i></button>
                                                                                        <button type="button" class="m-btn btn btn-default" disabled>1</button>
                                                                                        <button type="button" class="m-btn btn btn-default"><i class="fa fa-plus"></i></button>
                                                                                    </div>
                    </td>
                    <td>
                        <div class="price-wrap">
                            <var class="price">$45</var>
                        </div> <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                        <a href="" class="btn btn-outline-danger btn-round"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
                </table>
                </span>
                </div> <!-- card.// -->
                <div class="box">
                <dl class="dlist-align">
                  <dt>Tax: </dt>
                  <dd class="text-right">12%</dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Discount:</dt>
                  <dd class="text-right"><a href="#">0%</a></dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Sub Total:</dt>
                  <dd class="text-right">$215</dd>
                </dl>
                <dl class="dlist-align">
                  <dt>Total: </dt>
                  <dd class="text-right h4 b"> $215 </dd>
                </dl>
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn  btn-default btn-error btn-lg btn-block"><i class="fa fa-times-circle "></i> Cancel </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag"></i> Charge </a>
                    </div>
                </div>
                </div> <!-- box.// -->
                    </div>
                </div>
                </div><!-- container //  -->
                </section>

        </div>
      </div>



@include('common.footer')
@endsection


@section('pageJs')




<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>

    {{-- <script src="{{ asset('theme/pos/js/jquery-2.0.0.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/pos/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('theme/pos/js/OverlayScrollbars.js') }}"></script>

    <!-- END: Theme JS-->

    <script>
        	$(function() {
	//The passed argument has to be at least a empty object or a object with your desired options
	//$("body").overlayScrollbars({ });
	$("#items").height(552);
	$("#items").overlayScrollbars({overflowBehavior : {
		x : "hidden",
		y : "scroll"
	} });
	$("#cart").height(445);
	$("#cart").overlayScrollbars({ });
});
    //     $(document).ready(function () {

    //     $('#solo').click(function () {
    //         $('#company_extra').hide();
    //         $('#company_extra2').hide();

    //     });
    //     $('#company').click(function () {
    //         $('#company_extra').show();
    //         $('#company_extra2').show();

    //     });
    // });
    </script>

 @endsection
