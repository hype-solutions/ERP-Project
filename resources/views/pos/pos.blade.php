<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/OverlayScrollbars.css') }}">

    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style-rtl.css') }}"> --}}
    <!-- END: Custom CSS-->

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
</head>

<body>
    <section class="header-main">
        <div class="container">
    <div class="row align-items-center">
        <div class="col-lg-3">
        <div class="brand-wrap">
            <img class="logo" src="{{asset('theme/pos/images/items/noImg.jpg')}}">
            <h2 class="logo-text">بيع سريع</h2>
        </div> <!-- brand-wrap.// -->
        </div>
        <div class="col-lg-6 col-sm-6">

        </div> <!-- col.// -->
        <div class="col-lg-3 col-sm-6">
            <div class="widgets-wrap d-flex justify-content-end">
                <div class="widget-header">
                    <a href="#" class="icontext">
                        <a href="{{route('pos.landing')}}" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                                                                <i class="fa fa-home"></i>
                                                            </a>
                    </a>
                </div> <!-- widget .// -->
                <div class="widget-header dropdown">
                    <a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
                        <img src="{{asset('theme/pos/images/items/noImg.jpg')}}" class="avatar" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
                    </div> <!--  dropdown-menu .// -->
                </div> <!-- widget  dropdown.// -->
            </div>	<!-- widgets-wrap.// -->
        </div> <!-- col.// -->
    </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section>
      <section class="section-content padding-y-sm bg-default ">
        @foreach ($products as $item)
        <div class="modal fade text-left" id="product_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="myModalLabel1">{{$item->product_name}}</h4>
                    </div>
                    <div class="modal-body">
                        <table style="width: 100%;text-align: right;">
                            <tr>
                                <th>اسم المنتج:</th>
                                <td>{{$item->product_name}}</td>
                            </tr>
                            <tr>
                                <th>كود المنتج:</th>
                                <td>{{$item->product_code}}</td>
                            </tr>
                            <tr>
                                <th>رصيد المخزون:</th>
                                <td>{{ $item->product_total_in - $item->product_total_out }}</td>
                            </tr>
                            <tr>
                                <th>سعر البيع:</th>
                                <td>{{$item->product_price}} ج.م</td>
                            </tr>
                        </table>


                        <hr>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

         <div class="container-fluid">
            <div class="row">
               <div class="col-md-8 card padding-y-sm card ">
                   <div class="row">
                       <div class="col-md-6"><div class="input-group">
                        <input type="text" class="form-control" placeholder="إبحث عن منتج" id="searchInput">
                        <div class="input-group-prepend">
                          <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                    </div>
                </div>
                       <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="باركود" id="barcodeInput">
                            <div class="input-group-prepend">
                              <button class="btn btn-primary" type="submit">
                                <i class="fa fa-barcode"></i>
                              </button>
                            </div>
                        </div>
                       </div>
                   </div>
                  <ul class="nav bg radius nav-pills nav-fill mb-3 bg mt-2" role="tablist">
                    <li class="nav-item" id="search_tab" style="display: none">
                        <a class="nav-link" data-toggle="pill" href="#cat_search">
                        <i class="fa fa-search"></i> نتائج البحث</a>
                     </li>
                     <li class="nav-item" id="barcode_tab" style="display: none">
                        <a class="nav-link" data-toggle="pill" href="#cat_barcode">
                        <i class="fa fa-barcode"></i> نتائج الباركود</a>
                     </li>
                    <li class="nav-item" id="all_tab">
                        <a class="nav-link active show" data-toggle="pill" href="#all">
                        <i class="fa fa-tags"></i> جميع الفئات</a>
                     </li>
                     @foreach ($productsCategories as $cat)
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#cat_{{$cat->id}}">
                        <i class="fa fa-tags "></i>  {{$cat->cat_name}}</a>
                     </li>
                    @endforeach
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="all" aria-labelledby="active-pill"
                      aria-expanded="true">
                      <span id=" ">
                        <div class="row">
                           @foreach ($products as $item)
                           <div class="col-md-3">
                              <figure class="card card-product">
                                  @if($item->product_total_in - $item->product_total_out > 0)
                                 <span class="badge-avl"> متوفر </span>
                                 @else
                                 <span class="badge-new"> غير متوفر </span>
                                 @endif
                                 <div class="img-wrap">
                                     @if($item->product_image)
                                     <img src="{{asset($item->product_image)}}">
                                     @else
                                     <img src="{{asset('theme/pos/images/items/noImg.jpg')}}">
                                     @endif

                                    <a class="btn-overlay" href="#" data-toggle="modal" data-target="#product_{{$item->id}}"><i class="fa fa-search-plus"></i> نظرة سريعة</a>

                                </div>
                                 <figcaption class="info-wrap">
                                    <a href="#" class="title">{{$item->product_name}}</a>
                                    <div class="action-wrap">
                                        @if($item->product_total_in - $item->product_total_out > 0)
                                       <button type="button" class="btn btn-primary btn-sm float-right" onclick="return addToCart({{$item->id}})"> <i class="fa fa-cart-plus"></i> إضافة </button>
                                       @else
                                       <button type="button" class="btn btn-primary btn-sm float-right" disabled> <i class="fa fa-cart-plus"></i> إضافة </button>
                                       @endif
                                       <div class="price-wrap h5">
                                          <span class="price-new">{{$item->product_price}} ج.م</span>
                                       </div>
                                       <!-- price-wrap.// -->
                                    </div>
                                    <!-- action-wrap -->
                                 </figcaption>
                              </figure>
                              <!-- card // -->
                           </div>
                           <!-- col // -->
                           @endforeach
                        </div>
                        <!-- row.// -->
                     </span>
                    </div>
                    @foreach ($productsCategories as $cat)
                    <div class="tab-pane" id="cat_{{$cat->id}}" role="tabpanel" aria-labelledby="link-pill" aria-expanded="false">
                        <span id=" ">
                            <div class="row">
                               @foreach ($products as $key => $item)
                               @if($item->product_category == $cat->id)
                               <div class="col-md-3">
                                  <figure class="card card-product">
                                    @if($item->product_total_in - $item->product_total_out > 0)
                                    <span class="badge-avl"> متوفر </span>
                                    @else
                                    <span class="badge-new"> غير متوفر </span>
                                    @endif
                                     <div class="img-wrap">
                                         @if($item->product_image)
                                         <img src="{{asset($item->product_image)}}">
                                         @else
                                         <img src="{{asset('theme/pos/images/items/noImg.jpg')}}">
                                         @endif

                                         <a class="btn-overlay" href="#" data-toggle="modal" data-target="#product_{{$item->id}}"><i class="fa fa-search-plus"></i> نظرة سريعة</a>
                                        </div>
                                     <figcaption class="info-wrap">
                                        <a href="#" class="title">{{$item->product_name}}</a>
                                        <div class="action-wrap">
                                            @if($item->product_total_in - $item->product_total_out > 0)
                                            <button type="button" class="btn btn-primary btn-sm float-right" onclick="return addToCart({{$item->id}})"> <i class="fa fa-cart-plus"></i> إضافة </button>
                                            @else
                                            <button type="button" class="btn btn-primary btn-sm float-right" disabled> <i class="fa fa-cart-plus"></i> إضافة </button>
                                            @endif
                                            <div class="price-wrap h5">
                                              <span class="price-new">{{$item->product_price}} ج.م</span>
                                           </div>
                                           <!-- price-wrap.// -->
                                        </div>
                                        <!-- action-wrap -->
                                     </figcaption>
                                  </figure>
                                  <!-- card // -->
                               </div>
                               <!-- col // -->
                               @else
                               @endif
                               @endforeach

                            </div>
                            <!-- row.// -->
                         </span>
                    </div>
                    @endforeach


                  {{-- <div class="tab-content px-1 pt-1" id="search" style="display: none"> --}}
                    <div class="tab-pane" id="cat_search" role="tabpanel" aria-labelledby="link-pill" aria-expanded="false">
                        <span id=" ">
                            <div class="row" id="show_search"></div>
                         </span>
                    </div>
                   {{-- </div> --}}
                   {{-- <div class="tab-content px-1 pt-1" id="barcode" style="display: none"> --}}
                    <div class="tab-pane" id="cat_barcode" role="tabpanel" aria-labelledby="link-pill" aria-expanded="false">
                        <span id=" ">
                            <div class="row" id="show_barcode"></div>
                         </span>
                    </div>
                </div>
                   {{-- </div> --}}
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

                            @foreach ($currentCart as $item)
                            <tr>
                                 <td>
                                    <figure class="media">
                                       <figcaption class="media-body">
                                          <h6 class="title text-truncate">{{$item->product_name}}</h6>
                                       </figcaption>
                                    </figure>
                                 </td>
                                 <td class="text-center">
                                    <div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="...">
                                       <button type="button" class="m-btn btn btn-default btn-xs" onclick="return decrementProduct({{$item->product_id}})"><i class="fa fa-minus"></i></button>
                                       <button type="button" class="m-btn btn btn-default btn-xs" disabled>{{$item->product_qty}}</button>
                                       <button type="button" class="m-btn btn btn-default" onclick="return incrementProduct({{$item->product_id}})"><i class="fa fa-plus"></i></button>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="price-wrap">
                                       <var class="price">{{$item->product_qty * $item->product_price}} ج.م</var>
                                    </div>
                                    <!-- price-wrap .// -->
                                 </td>
                                 <td class="text-right">
                                    <a href="#" class="btn btn-outline-danger" onclick="return removeFromCart({{$item->product_id}})"> <i class="fa fa-trash"></i></a>
                                 </td>
                              </tr>
                              @endforeach



                           </tbody>
                        </table>
                     </span>
                  </div>
                  <!-- card.// -->
                  <div class="box">
                     <dl class="dlist-align">
                        <dt>الضريبة: </dt>
                        <dd class="text-right">0%</dd>
                     </dl>
                     <dl class="dlist-align">
                        <dt>الخصم:</dt>
                        <dd class="text-right"><a href="#">0%</a></dd>
                     </dl>
                     <dl class="dlist-align">
                        <dt>الإجمالي:</dt>
                        <dd class="text-right">0 ج.م</dd>
                     </dl>
                     <dl class="dlist-align">
                        <dt>الإجمالي: </dt>
                        <dd class="text-right h4 b"> 0 ج.م </dd>
                     </dl>
                     <div class="row">

                        <div class="col-md-12">
                           <a href="#" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag"></i> إنهاء </a>
                        </div>
                     </div>
                  </div>
                  <!-- box.// -->
               </div>
            </div>
         </div>
         <!-- container //  -->
      </section>

    <script src="{{ asset('theme/pos/js/jquery-2.0.0.min.js') }}"></script>
    <script src="{{ asset('theme/pos/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/pos/js/OverlayScrollbars.js') }}"></script>

    <!-- END: Theme JS-->

    <script>

function refreshSummary(){

}

function removeFromCart(productId){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formData = {
                product: productId,
                sess: {{$sessionId}},
            };
            var type = "POST";
            var ajaxurl = "{{route('pos.removeFromCart')}}";
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                refreshCart();
            },
            error: function (data) {
                console.log(data);
            }
        });
}

function incrementProduct(productId){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formData = {
                product: productId,
                sess: {{$sessionId}},
            };
            var type = "POST";
            var ajaxurl = "{{route('pos.increment')}}";
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                refreshCart();
            },
            error: function (data) {
                console.log(data);
            }
        });
}


function decrementProduct(productId){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formData = {
                product: productId,
                sess: {{$sessionId}},
            };
            var type = "POST";
            var ajaxurl = "{{route('pos.decrement')}}";
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                refreshCart();
            },
            error: function (data) {
                console.log(data);
            }
        });
}


function refreshCart(){
$('#cart').find('tbody').empty();
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formData = {
                sess: {{$sessionId}},
            };
            var type = "POST";
            var ajaxurl = "{{route('pos.refreshcart')}}";
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                for(var i = 0; i < data.data.length; i++){

                $('#cart').find('tbody').append('<tr><td><figure class="media"><figcaption class="media-body"><h6 class="title text-truncate">'+data.data[i].product_name+'</h6></figcaption></figure></td><td class="text-center"><div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..."><button type="button" class="m-btn btn btn-default btn-xs" onclick="return decrementProduct('+data.data[i].product_id+')"><i class="fa fa-minus"></i></button><button type="button" class="m-btn btn btn-default btn-xs" disabled>'+data.data[i].product_qty+'</button><button type="button" class="m-btn btn btn-default"  onclick="return incrementProduct('+data.data[i].product_id+')"><i class="fa fa-plus"></i></button></div></td><td><div class="price-wrap"><var class="price">'+data.data[i].product_price * data.data[i].product_qty+' ج.م</var></div></td><td class="text-right"><a href="#" class="btn btn-outline-danger" onclick="return removeFromCart('+data.data[i].product_id+')"> <i class="fa fa-trash"></i></a></td></tr>');
                    refreshSummary();
                }
            },
            error: function (data) {
                console.log(data);
            }
        });


}


function addToCart(productId){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formData = {
                product: productId,
                sess: {{$sessionId}},
            };
            var type = "POST";
            var ajaxurl = "{{route('pos.addtocart')}}";
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                refreshCart();
            },
            error: function (data) {
                console.log(data);
            }
        });
}


    $("#searchInput").keyup(function() {
        if (!this.value) {
            $('#show_search').empty();
            $('#cat_search').removeClass('show');
            $('#cat_search').removeClass('active');
            $('#all').addClass('show');
            $('#all').addClass('active');

            $('#search').css('display','none');
            $('#barcode').css('display','none');
            $('#search_tab').css('display','none');
            $('#barcode_tab').css('display','none');
            // $('#categories').css('display','block');
            $('#all_tab a').eq(0).addClass('show');
            $('#all_tab a').eq(0).addClass('active');
            $('#search_tab a').eq(0).removeClass('show');
            $('#search_tab a').eq(0).removeClass('active');
        }else{
            if($(this).val().length > 2) {
                $('#show_search').empty();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formData = {
                search: $('#searchInput').val(),
            };
            var type = "POST";
            var ajaxurl = "{{route('pos.search')}}";
            $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                // console.log(data.data.length);
                for(var i = 0; i < data.data.length; i++){
                    var addBtn,productStatus;
                if(data.data[i].product_total_in - data.data[i].product_total_out > 0){
                    addBtn = '<a href="#" class="btn btn-primary btn-sm float-right"> <i class="fa fa-cart-plus"></i> إضافة </a>';
                    productStatus = '<span class="badge-avl">متوفر </span>';
                }else{
                    addBtn = '<button type="button" class="btn btn-primary btn-sm float-right" disabled> <i class="fa fa-cart-plus"></i> إضافة </button>';
                    productStatus = '<span class="badge-new"> غير متوفر </span>';
                }
                $('#show_search').append('<div class="col-md-3"><figure class="card card-product">'+productStatus+'<div class="img-wrap"><img src="/theme/pos/images/items/noImg.jpg"><a class="btn-overlay" href="#" data-toggle="modal" data-target="#product_'+data.data[i].id+'"><i class="fa fa-search-plus" ></i> نظرة سريعة</a></div><figcaption class="info-wrap"><a href="#" class="title">'+data.data[i].product_name+'</a><div class="action-wrap">'+addBtn+'<div class="price-wrap h5"><span class="price-new">'+data.data[i].product_price+' ج.م</span></div></div></figcaption></figure></div>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
            $('#cat_search').addClass('show');
            $('#cat_search').addClass('active');
            $('#all').removeClass('show');
            $('#all').removeClass('active');

            $('#search').css('display','block');
            $('#barcode').css('display','none');
            $('#search_tab').css('display','block');
            $('#barcode_tab').css('display','none');
            // $('#categories').css('display','none');
            $('#search_tab a').eq(0).addClass('show');
            $('#search_tab a').eq(0).addClass('active');
            $('#all_tab a').eq(0).removeClass('show');
            $('#all_tab a').eq(0).removeClass('active');
        }
        }
        });

    $("#barcodeInput").keyup(function() {
        if (!this.value) {
            $('#show_barcode').empty();
            $('#cat_barcode').removeClass('show');
            $('#cat_barcode').removeClass('active');
            $('#all').addClass('show');
            $('#all').addClass('active');
            $('#show_barcode').empty();
            $('#search').css('display','none');
            $('#barcode').css('display','none');
            $('#search_tab').css('display','none');
            $('#barcode_tab').css('display','none');
            // $('#categories').css('display','block');
            $('#all_tab a').eq(0).addClass('show');
            $('#all_tab a').eq(0).addClass('active');
            $('#barcode_tab a').eq(0).removeClass('show');
            $('#barcode_tab a').eq(0).removeClass('active');
        }else{

            if($(this).val().length > 1) {
                $('#show_barcode').empty();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                    });
            var formDatax = {
                barcode: $('#barcodeInput').val(),
            };
            var typex = "POST";
            var ajaxurlx = "{{route('pos.barcode')}}";
            $.ajax({
            type: typex,
            url: ajaxurlx,
            data: formDatax,
            dataType: 'json',
            success: function (datax) {

                for(var i = 0; i < datax.datax.length; i++){
                var addBtn;
                if(datax.datax[i].product_total_in - datax.datax[i].product_total_out > 0){
                    addBtn = '<a href="#" class="btn btn-primary btn-sm float-right"> <i class="fa fa-cart-plus"></i> إضافة </a>';
                    productStatus = '<span class="badge-avl">متوفر </span>';
                }else{
                    addBtn = '<button type="button" class="btn btn-primary btn-sm float-right" disabled> <i class="fa fa-cart-plus"></i> إضافة </button>';
                    productStatus = '<span class="badge-new"> غير متوفر </span>';
                }
                $('#show_barcode').append('<div class="col-md-3"><figure class="card card-product">'+productStatus+'<div class="img-wrap"><img src="/theme/pos/images/items/noImg.jpg"><a class="btn-overlay" href="#" data-toggle="modal" data-target="#product_'+datax.datax[i].id+'"><i class="fa fa-search-plus"></i> نظرة سريعة</a></div><figcaption class="info-wrap"><a href="#" class="title">'+datax.datax[i].product_name+'</a><div class="action-wrap">'+addBtn+'<div class="price-wrap h5"><span class="price-new">'+datax.datax[i].product_price+' ج.م</span></div></div></figcaption></figure></div>');
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
            $('#cat_barcode').addClass('show');
            $('#cat_barcode').addClass('active');
            $('#all').removeClass('show');
            $('#all').removeClass('active');
            $('#search').css('display','none');
            $('#barcode').css('display','block');
            $('#search_tab').css('display','none');
            $('#barcode_tab').css('display','block');
            // $('#categories').css('display','none');
            $('#barcode_tab a').eq(0).addClass('show');
            $('#barcode_tab a').eq(0).addClass('active');
            $('#all_tab a').eq(0).removeClass('show');
            $('#all_tab a').eq(0).removeClass('active');
            }
        }
        });


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

</body>
</html>
