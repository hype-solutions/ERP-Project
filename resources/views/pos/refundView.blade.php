@extends('layouts.erp')
@section('title', 'البيع السريع')

@section('pageCss')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/simple-line-icons/style.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/OverlayScrollbars.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/pos/css/easy-numpad.css') }}">
    <style>
        .avatar {
            vertical-align: middle;
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .bg-default,
        .btn-default {
            background-color: #f2f3f8;
        }

        .btn-error {
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
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">نقاط البيع</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pos.landing') }}">نقاط البيع</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pos.refunds') }}">المرتجعات</a></li>
                            <li class="breadcrumb-item active">إرجاع فاتورة
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- users list start -->
            <script type="text/javascript">
                function pay(url) {
                    popupWindow = window.open(
                        url, 'popUpWindow',
                        'height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no'
                    )
                }
            </script>
            @if (session()->has('popup'))
                <script>
                    pay('{{ route('pos.receipt', session()->get('session')) }}');
                </script>
            @endif



            <section class="users-list-wrapper">
                @if (session()->has('error'))
                    @if (session()->get('error') == 'phone not unique')
                        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>خطأ!</strong> هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر
                        </div>
                    @endif
                @endif

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">

                                                <tbody>
                                                    <tr>
                                                        <td>الفرع</td>
                                                        <td>{{ $currentSession->branch->branch_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الكاشير</td>
                                                        <td>{{ $currentSession->sell_user->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>العميل</td>
                                                        @if ($currentSession->customer)
                                                            <td>{{ $currentSession->customer->customer_name }}</td>
                                                        @else
                                                            <td>زائر</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>وقت البيع</td>
                                                        <td>{{ $currentSession->sold_when }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">

                                                <tbody>
                                                    <tr>
                                                        <th>المجموع</th>
                                                        <td><span id="total_after_all">{{ $subtotal }}</span> ج.م</td>
                                                    </tr>
                                                    <tr id="hidden-row-1" @if ($currentSession->discount_percentage <= 0) style="display:none" @endif>
                                                        <th>الخصم (النسبة)</th>
                                                        <td>[<span id="discount_percentage"
                                                                style="color: goldenrod">{{ $currentSession->discount_percentage }}</span>
                                                            %] <span
                                                                id="discount_percentage_amount">{{ $subtotal - $currentSession->total }}</span>
                                                            ج.م</td>
                                                    </tr>
                                                    <tr id="hidden-row-2" @if ($currentSession->discount_amount <= 0)  style="display:none" @endif>
                                                        <th>الخصم (المبلغ)</th>
                                                        <td><span
                                                                id="discount_amount">{{ $currentSession->discount_amount }}</span>
                                                            ج.م
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>الإجمالي</th>
                                                        <td><span
                                                                id="total_after_all2">{{ $currentSession->total }}</span>
                                                            ج.م</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <a href="{{ route('pos.refunds') }}"
                                                class="btn mb-1 btn-secondary btn-lg btn-block">الغاء و
                                                العوده للصفحة السابقة</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <!-- Block level buttons with icon -->
                                        <div class="form-group">
                                            <button type="button" class="btn mb-1 btn-success btn-icon btn-lg btn-block"
                                                onclick="return save()"><i class="la la-check-circle"></i> حفظ
                                                التعديلات</button>
                                            <a onclick="return confirm('هل أنت متأكد؟')"
                                                href="{{ route('pos.refunds.all', $session) }}"
                                                class="btn mb-1 btn-danger btn-icon btn-lg btn-block">إرجاع بالكامل</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('pos.refunds.some') }}" method="POST" id="theCart">
                            @csrf
                            <input type="hidden" name="sessionId" value="{{ $session }}" />

                            <input type="hidden" name="total" id="totalToSave" value="{{ $currentSession->total }}" />
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
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
                                                <span style="display: none">{{ $subtotal = 0 }}</span>
                                                @if (!empty($currentCart))
                                                    @foreach ($currentCart as $key => $item)
                                                        <tr id="cart_item_{{ $item->product_id }}">
                                                            <input type="hidden" name="item[{{ $item->product_id }}][id]"
                                                                value="{{ $item->product_id }}" />
                                                            <input type="hidden"
                                                                name="item[{{ $item->product_id }}][name]"
                                                                value="{{ $item->product_name }}" />
                                                            <input type="hidden"
                                                                name="item[{{ $item->product_id }}][qty]"
                                                                value="{{ $item->product_qty }}" />
                                                            <input type="hidden"
                                                                name="item[{{ $item->product_id }}][price]"
                                                                value="{{ $item->product_price }}" />
                                                            <td>
                                                                <figure class="media">
                                                                    <figcaption class="media-body">
                                                                        <h6 class="title text-truncate">
                                                                            {{ $item->product_name }}</h6>
                                                                    </figcaption>
                                                                </figure>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="m-btn-group m-btn-group--pill btn-group mr-2"
                                                                    role="group" aria-label="...">
                                                                    <button type="button"
                                                                        class="m-btn btn btn-default btn-xs"
                                                                        onclick="return decrementProduct({{ $item->product_id }},'{{ $item->product_name }}',{{ $item->product_price }})"><i
                                                                            class="la la-minus"></i></button>
                                                                    <button type="button"
                                                                        class="m-btn btn btn-default btn-xs" disabled
                                                                        id="item_qty_{{ $item->product_id }}">{{ $item->product_qty }}</button>

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="price-wrap">
                                                                    <var class="price"><span
                                                                            id="tot_{{ $item->product_id }}">{{ $item->product_qty * $item->product_price }}</span>
                                                                        ج.م</var>
                                                                </div>
                                                                <!-- price-wrap .// -->
                                                            </td>
                                                            <td class="text-right">
                                                                <a href="#" class="btn btn-outline-danger"
                                                                    onclick="return removeFromCart({{ $item->product_id }},{{ $item->product_price }},'{{ $item->product_name }}')">
                                                                    <i class="la la-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                        <span
                                                            style="display: none">{{ $subtotal += $item->product_price * $item->product_qty }}</span>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script
        src="{{ asset('theme/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-print.min.js') }}">
    </script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/jszip.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>


    <script src="{{ asset('theme/pos/js/OverlayScrollbars.js') }}"></script>
    <script src="{{ asset('theme/pos/js/easy-numpad.js') }}"></script>
    <script>
        function save() {
            $('#theCart').submit();
        }

        function closeDiscountsModal() {
            calculateDiscount(2);

            $('#discounts').modal('toggle');
        }

        function applyPercentage(per) {
            $('#curr_per').val(per);
            calculateDiscount(1);
            $('#discounts').modal('toggle');

        }

        function calculateDiscount(theType) {
            //clear old discount
            $('#discount_percentage').text(0);
            $('#discount_percentage_amount').text(0);
            $('#discount_amount').text(0);
            // if discount type is percentage
            if (theType == 1) {
                var theValue = $('#curr_per').val();
                if ($('#curr_per').val().length === 0) {
                    theValue = 0;
                }
                if (theValue > 0) {
                    $('#hidden-row-1').show();
                } else {
                    $('#hidden-row-1').hide();
                }
                $('#curr_amount').val(0);
                var currentDiscountP = $('#discount_percentage').text();
                currentDiscountP = parseInt(currentDiscountP);
                var currentInvoiceTotal = $("#total_after_all").text();
                currentInvoiceTotal = parseInt(currentInvoiceTotal);
                var newInvoiceTotal = currentInvoiceTotal - (currentInvoiceTotal * (theValue / 100));
                var discount_amount = currentInvoiceTotal - newInvoiceTotal;
                discount_amount = Math.floor(discount_amount);
                $('#discount_percentage').text(theValue);
                $('#discount_percentage_amount').text(discount_amount);
                //   $('#totalDP').val('theValue');
            }
            //if discount type is fixed
            else if (theType == 2) {
                var theValue = $('#curr_amount').val();
                if ($('#curr_amount').val().length === 0) {
                    theValue = 0;
                }
                if (theValue > 0) {
                    $('#hidden-row-2').show();
                } else {
                    $('#hidden-row-2').hide();
                }
                $('#curr_per').val(0);
                var currentDiscountA = $('#discount_amount').text();
                currentDiscountA = parseInt(currentDiscountA);
                var currentInvoiceTotal = $("#total_after_all").text();
                currentInvoiceTotal = parseInt(currentInvoiceTotal);
                var newInvoiceTotal = parseInt(currentInvoiceTotal) + parseInt(currentDiscountA) - parseInt(theValue);
                $('#discount_amount').text(theValue);
                //   $('#totalDA').val('theValue');
            }
            updateTotal();
        }

        function updateTotal() {

            //get sub total
            var getSubTotal = $("#total_after_all").text();
            getSubTotal = parseInt(getSubTotal);
            //get discount amount
            var getDiscountAmount_1 = $('#discount_percentage_amount').text();
            var getDiscountAmount_2 = $('#discount_amount').text();
            getDiscountAmount_1 = parseInt(getDiscountAmount_1);
            getDiscountAmount_2 = parseInt(getDiscountAmount_2);
            //add them all
            var invoiceTotal = getSubTotal - getDiscountAmount_1 - getDiscountAmount_2;
            $('#total_after_all2').text(invoiceTotal);
            $('#totalToSave').val(invoiceTotal);

        }



        function decrementProduct(productId, productName, productPrice) {
            var getCurrentQty = $('#item_qty_' + productId).text();
            var productQty = parseInt(getCurrentQty) - 1;
            var oldTotalPrice = parseInt(getCurrentQty) * parseInt(productPrice);
            var newTotalPrice = (parseInt(getCurrentQty) - 1) * parseInt(productPrice);
            oldTotalPrice = parseInt(oldTotalPrice);
            newTotalPrice = parseInt(newTotalPrice);
            if (getCurrentQty == 1) {
                // $('#cart_item_' + productId).remove();
                $('#cart_item_' + productId).html('<input type="hidden" name="item[' + productId + '][id]" value="' +
                    productId + '" /><input type="hidden" name="item[' + productId + '][name]" value="' + productName +
                    '" /><input type="hidden" name="item[' + productId + '][qty]" value="' + productQty +
                    '" /><input type="hidden" name="item[' + productId + '][price]" value="' + productPrice +
                    '" /><td><figure class="media"><figcaption class="media-body"><h6 class="title text-truncate">' +
                    productName +
                    '</h6></figcaption></figure></td><td class="text-center"><div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..."><button type="button" class="m-btn btn btn-default btn-xs" disabled><i class="la la-minus"></i></button><button type="button" class="m-btn btn btn-default btn-xs" disabled id="item_qty_' +
                    productId + '">' + productQty +
                    '</button></div></td><td><div class="price-wrap"><var class="price"><span id="tot_' +
                    productId + '">' + productPrice * productQty +
                    '</span> ج.م</var></div></td><td class="text-right"></td>');
            } else {
                $('#cart_item_' + productId).html('<input type="hidden" name="item[' + productId + '][id]" value="' +
                    productId + '" /><input type="hidden" name="item[' + productId + '][name]" value="' + productName +
                    '" /><input type="hidden" name="item[' + productId + '][qty]" value="' + productQty +
                    '" /><input type="hidden" name="item[' + productId + '][price]" value="' + productPrice +
                    '" /><td><figure class="media"><figcaption class="media-body"><h6 class="title text-truncate">' +
                    productName +
                    '</h6></figcaption></figure></td><td class="text-center"><div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..."><button type="button" class="m-btn btn btn-default btn-xs" onclick="return decrementProduct(' +
                    productId + ',\'' + productName + '\',' + productPrice +
                    ')"><i class="la la-minus"></i></button><button type="button" class="m-btn btn btn-default btn-xs" disabled id="item_qty_' +
                    productId + '">' + productQty +
                    '</button></div></td><td><div class="price-wrap"><var class="price"><span id="tot_' +
                    productId + '">' + productPrice * productQty +
                    '</span> ج.م</var></div></td><td class="text-right"><a href="#" class="btn btn-outline-danger" onclick="return removeFromCart(' +
                    productId + ',' + productPrice + ',' + productName + ')"> <i class="la la-trash"></i></a></td>');
            }
            reCalculate(productId, oldTotalPrice, newTotalPrice);
        }

        function removeFromCart(productId, productPrice, productName) {
            var productQty = 0;
            var getCurrentQty = $('#item_qty_' + productId).text();
            var oldTotalPrice = parseInt(getCurrentQty) * parseInt(productPrice);
            var newTotalPrice = 0;
            oldTotalPrice = parseInt(oldTotalPrice);
            newTotalPrice = parseInt(newTotalPrice);
            // $('#cart_item_' + productId).remove();

            $('#cart_item_' + productId).html('<input type="hidden" name="item[' + productId + '][id]" value="' +
                productId + '" /><input type="hidden" name="item[' + productId + '][name]" value="' + productName +
                '" /><input type="hidden" name="item[' + productId + '][qty]" value="' + productQty +
                '" /><input type="hidden" name="item[' + productId + '][price]" value="' + productPrice +
                '" /><td><figure class="media"><figcaption class="media-body"><h6 class="title text-truncate">' +
                productName +
                '</h6></figcaption></figure></td><td class="text-center"><div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..."><button type="button" class="m-btn btn btn-default btn-xs" disabled><i class="la la-minus"></i></button><button type="button" class="m-btn btn btn-default btn-xs" disabled id="item_qty_' +
                productId + '">' + productQty +
                '</button></div></td><td><div class="price-wrap"><var class="price"><span id="tot_' +
                productId + '">' + productPrice * productQty +
                '</span> ج.م</var></div></td><td class="text-right"></td>');

            reCalculate(productId, oldTotalPrice, newTotalPrice);
        }

        function updateDiscount() {
            var discount_percentage = $('#curr_per').val();
            var discount_amount = $('#curr_amount').val();
            if (discount_percentage > 0) {
                discount_percentage = parseInt(discount_percentage);
                calculateDiscount(1, discount_percentage);
            }

            if (discount_amount > 0) {
                discount_amount = parseInt(discount_amount);
                calculateDiscount(2, discount_amount);
            }

        }

        function reCalculate(productId, oldTotalPrice, newTotalPrice) {
            console.log(oldTotalPrice);
            console.log(newTotalPrice);
            var currentTotal = $("#total_after_all").text();
            currentTotal = parseInt(currentTotal);
            var newTotal = currentTotal - oldTotalPrice;
            newTotal = newTotal + newTotalPrice;
            $('#total_after_all').text(newTotal);
            updateDiscount();
            updateTotal();

        }

        function addCustomer() {
            $('#addCustomerBtn').attr('disabled', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                customer_name: $('#new_customer_name').val(),
                customer_mobile: $('#new_customer_mobile').val(),
                session: {{ $session }},
            };
            var type = "POST";
            var ajaxurl = "{{ route('pos.quickadd') }}";
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.data > 0) {
                        $('#saved_name').text($('#new_customer_name').val());
                        $('#saved_mobile').text($('#new_customer_mobile').val());
                        $('#new_customer_1').css('display', 'none');
                        $('#new_customer_2').css('display', 'none');
                        $('#new_customer_3').css('display', 'block');
                    } else {
                        $('#new_customer_error').css('display', 'block');
                    }
                    $('#addCustomerBtn').attr('disabled', false);
                },
                error: function(data) {
                    console.log(data);
                }
            });


        }



        // function addToCart(productId,productName,productPrice){

        //     if($("#cart_item_" + productId).length > 0) {
        //         var getCurrentQty = $('#item_qty_'+productId).text();
        //         var productQty = 1 + parseInt(getCurrentQty);
        //         $('#cart_item_' + productId).html('<input type="hidden" name="item['+productId+'][id]" value="'+productId+'" /><input type="hidden" name="item['+productId+'][name]" value="'+productName+'" /><input type="hidden" name="item['+productId+'][qty]" value="'+productQty+'" /><input type="hidden" name="item['+productId+'][price]" value="'+productPrice+'" /><td><figure class="media"><figcaption class="media-body"><h6 class="title text-truncate">'+productName+'</h6></figcaption></figure></td><td class="text-center"><div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..."><button type="button" class="m-btn btn btn-default btn-xs" onclick="return decrementProduct('+productId+',\''+productName+'\','+productPrice+')"><i class="la la-minus"></i></button><button type="button" class="m-btn btn btn-default btn-xs" disabled id="item_qty_'+productId+'">'+productQty+'</button><button type="button" class="m-btn btn btn-default"  onclick="return incrementProduct('+productId+',\''+productName+'\','+productPrice+')"><i class="la la-plus"></i></button></div></td><td><div class="price-wrap"><var class="price"><span id="tot_'+productId+'">'+productPrice * productQty+'</span> ج.م</var></div></td><td class="text-right"><a href="#" class="btn btn-outline-danger" onclick="return removeFromCart('+productId+','+productPrice+')"> <i class="la la-trash"></i></a></td>');
        //     }else{
        //         var productQty = 1;
        //         var getCurrentQty = 0;
        //         $('#cart').find('tbody').append('<tr id="cart_item_'+productId+'"><input type="hidden" name="item['+productId+'][id]" value="'+productId+'" /><input type="hidden" name="item['+productId+'][name]" value="'+productName+'" /><input type="hidden" name="item['+productId+'][qty]" value="'+productQty+'" /><input type="hidden" name="item['+productId+'][price]" value="'+productPrice+'" /><td><figure class="media"><figcaption class="media-body"><h6 class="title text-truncate">'+productName+'</h6></figcaption></figure></td><td class="text-center"><div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..."><button type="button" class="m-btn btn btn-default btn-xs" onclick="return decrementProduct('+productId+',\''+productName+'\','+productPrice+')"><i class="la la-minus"></i></button><button type="button" class="m-btn btn btn-default btn-xs" disabled id="item_qty_'+productId+'">'+productQty+'</button><button type="button" class="m-btn btn btn-default"  onclick="return incrementProduct('+productId+',\''+productName+'\','+productPrice+')"><i class="la la-plus"></i></button></div></td><td><div class="price-wrap"><var class="price"><span id="tot_'+productId+'">'+productPrice * productQty+'</span> ج.م</var></div></td><td class="text-right"><a href="#" class="btn btn-outline-danger" onclick="return removeFromCart('+productId+','+productPrice+')"> <i class="la la-trash"></i></a></td></tr>');
        //     }
        //         var oldTotalPrice = parseInt(getCurrentQty) * parseInt(productPrice);
        //         var newTotalPrice = (parseInt(getCurrentQty) + 1) * parseInt(productPrice);
        //             oldTotalPrice = parseInt(oldTotalPrice);
        //             newTotalPrice = parseInt(newTotalPrice);
        //         reCalculate(productId,oldTotalPrice,newTotalPrice);
        // }

        var searching = 0;
        $("#searchInput").keyup(function() {
            if (searching == 0) {
                if (!this.value) {
                    $('#show_search').empty();
                    $('#cat_search').removeClass('show');
                    $('#cat_search').removeClass('active');
                    $('#all').addClass('show');
                    $('#all').addClass('active');

                    $('#search').css('display', 'none');
                    $('#barcode').css('display', 'none');
                    $('#search_tab').css('display', 'none');
                    $('#barcode_tab').css('display', 'none');
                    // $('#categories').css('display','block');
                    $('#all_tab a').eq(0).addClass('show');
                    $('#all_tab a').eq(0).addClass('active');
                    $('#search_tab a').eq(0).removeClass('show');
                    $('#search_tab a').eq(0).removeClass('active');
                } else {
                    if ($(this).val().length > 2) {
                        searching = 1;
                        $('#show_search').empty();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var formData = {
                            search: $('#searchInput').val(),
                            session: {{ $session }},
                        };
                        var type = "POST";
                        var ajaxurl = "{{ route('pos.search') }}";
                        $.ajax({
                            type: type,
                            url: ajaxurl,
                            data: formData,
                            dataType: 'json',
                            beforeSend: function() {
                                // $('#searchInput').prop('readonly', true);
                            },
                            success: function(data) {
                                console.log(data.data);
                                // $('#searchInput').prop('readonly', false);
                                // $item->amountInBranch($currentSession->branch_id)
                                for (var i = 0; i < data.data.length; i++) {
                                    var addBtn, productStatus;
                                    // if (data.data[i].product_total_in - data.data[i].product_total_out > 0) {
                                    if (data.data[i].availability > 0) {
                                        addBtn =
                                            '<button type="button" class="btn btn-primary btn-sm float-right" onclick="return addToCart(' +
                                            data.data[i].id + ',\'' + data.data[i].product_name +
                                            '\',' +
                                            data.data[i].product_price + ',' + (data.data[i]
                                                .product_in -
                                                data.data[i].product_out) +
                                            ')"> <i class="la la-cart-plus"></i> إضافة </button>';
                                        productStatus = '<span class="badge-avl">متوفر </span>';
                                    } else {
                                        addBtn =
                                            '<button type="button" class="btn btn-primary btn-sm float-right" disabled> <i class="la la-cart-plus"></i> إضافة </button>';
                                        productStatus = '<span class="badge-new"> غير متوفر </span>';
                                    }
                                    var noImg = "{{ asset('theme/pos/images/items/noImg.jpg') }}";
                                    $('#show_search').append(
                                        '<div class="col-md-3"><figure class="card card-product">' +
                                        productStatus + '<div class="img-wrap"><img src="' + noImg +
                                        '"><a class="btn-overlay" href="#" data-toggle="modal" data-target="#product_' +
                                        data.data[i].id +
                                        '"><i class="la la-search-plus" ></i> نظرة سريعة</a></div><figcaption class="info-wrap"><a href="#" class="title">' +
                                        data.data[i].product_name +
                                        '</a><div class="action-wrap">' +
                                        addBtn +
                                        '<div class="price-wrap h5"><span class="price-new">' +
                                        data.data[i].product_price +
                                        ' ج.م</span></div></div></figcaption></figure></div>');
                                }
                                searching = 0;
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                        $('#cat_search').addClass('show');
                        $('#cat_search').addClass('active');
                        $('#all').removeClass('show');
                        $('#all').removeClass('active');

                        $('#search').css('display', 'block');
                        $('#barcode').css('display', 'none');
                        $('#search_tab').css('display', 'block');
                        $('#barcode_tab').css('display', 'none');
                        // $('#categories').css('display','none');
                        $('#search_tab a').eq(0).addClass('show');
                        $('#search_tab a').eq(0).addClass('active');
                        $('#all_tab a').eq(0).removeClass('show');
                        $('#all_tab a').eq(0).removeClass('active');
                    }
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
                $('#search').css('display', 'none');
                $('#barcode').css('display', 'none');
                $('#search_tab').css('display', 'none');
                $('#barcode_tab').css('display', 'none');
                // $('#categories').css('display','block');
                $('#all_tab a').eq(0).addClass('show');
                $('#all_tab a').eq(0).addClass('active');
                $('#barcode_tab a').eq(0).removeClass('show');
                $('#barcode_tab a').eq(0).removeClass('active');
            } else {

                if ($(this).val().length > 1) {
                    $('#show_barcode').empty();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var formDatax = {
                        barcode: $('#barcodeInput').val(),
                        session: {{ $session }},
                    };
                    var typex = "POST";
                    var ajaxurlx = "{{ route('pos.barcode') }}";
                    $.ajax({
                        type: typex,
                        url: ajaxurlx,
                        data: formDatax,
                        dataType: 'json',
                        success: function(datax) {

                            for (var i = 0; i < datax.datax.length; i++) {
                                var addBtn;
                                if (datax.datax[i].product_total_in - datax.datax[i].product_total_out >
                                    0) {
                                    addBtn =
                                        '<button type="button" class="btn btn-primary btn-sm float-right" onclick="return addToCart(' +
                                        datax.datax[i].id + ',\'' + datax.datax[i].product_name +
                                        '\',' + datax.datax[i].product_price + ',' + (datax.datax[i]
                                            .product_in - datax.datax[i].product_out) +
                                        ')"> <i class="la la-cart-plus"></i> إضافة </button>';
                                    productStatus = '<span class="badge-avl">متوفر </span>';
                                } else {
                                    addBtn =
                                        '<button type="button" class="btn btn-primary btn-sm float-right" disabled> <i class="la la-cart-plus"></i> إضافة </button>';
                                    productStatus = '<span class="badge-new"> غير متوفر </span>';
                                }
                                var noImg = "{{ asset('theme/pos/images/items/noImg.jpg') }}";
                                $('#show_barcode').append(
                                    '<div class="col-md-3"><figure class="card card-product">' +
                                    productStatus + '<div class="img-wrap"><img src="' + noImg +
                                    '"><a class="btn-overlay" href="#" data-toggle="modal" data-target="#product_' +
                                    datax.datax[i].id +
                                    '"><i class="la la-search-plus"></i> نظرة سريعة</a></div><figcaption class="info-wrap"><a href="#" class="title">' +
                                    datax.datax[i].product_name + '</a><div class="action-wrap">' +
                                    addBtn + '<div class="price-wrap h5"><span class="price-new">' +
                                    datax.datax[i].product_price +
                                    ' ج.م</span></div></div></figcaption></figure></div>');
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                    $('#cat_barcode').addClass('show');
                    $('#cat_barcode').addClass('active');
                    $('#all').removeClass('show');
                    $('#all').removeClass('active');
                    $('#search').css('display', 'none');
                    $('#barcode').css('display', 'block');
                    $('#search_tab').css('display', 'none');
                    $('#barcode_tab').css('display', 'block');
                    // $('#categories').css('display','none');
                    $('#barcode_tab a').eq(0).addClass('show');
                    $('#barcode_tab a').eq(0).addClass('active');
                    $('#all_tab a').eq(0).removeClass('show');
                    $('#all_tab a').eq(0).removeClass('active');
                }
            }
        });

        $(function() {
            $("#saveCart").click(function(e) {
                e.preventDefault();
                $('#end_or_save').val(0);
                $("#theCart").submit(); // Submit the form
            });

            //The passed argument has to be at least a empty object or a object with your desired options
            //$("body").overlayScrollbars({ });
            $("#items").height(552);
            $("#items").overlayScrollbars({
                overflowBehavior: {
                    x: "hidden",
                    y: "scroll"
                }
            });
            $("#cart").height(445);
            $("#cart").overlayScrollbars({});
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
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
    <!-- END: Page JS-->
@endsection
