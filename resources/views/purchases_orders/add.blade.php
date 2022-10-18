@extends('layouts.erp')
@section('title', 'أمر شراء جديد')

@section('pageCss')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/switch.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-switch.min.css') }}">

    <style>
        .ck-editor__editable {
            min-height: 150px;
        }

        .product_input {
            width: 100%;
            padding: 0 4px;
            overflow: hidden;
            line-height: 17px;
            height: 40px;
            resize: none;
            background: 0 0;
            margin: 0;
            font-size: 12px;
            border: none;
        }

        .product_sel {
            margin-bottom: 0 !important;
        }

        #myTable tr td {
            padding: 0 !important;
            margin: 0 !important;
        }

    </style>
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">أوامر الشراء</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('purchasesorders.list') }}">أوامر الشراء</a></li>
                            <li class="breadcrumb-item active">إضافة
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- users view start -->
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



                @if (session()->has('success'))
                    <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>تم بنجاح!</strong> تحديث ملف المنتج
                    </div>
                @endif

                <form method="POST" action="{{ route('purchasesorders.adding') }}">
                    @csrf


                    <input type="hidden" name="added_by" value="{{ $user_id }}" />
                    <input type="hidden" name="purchase_total" id="totalToSave" value="0" />

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-flag"></i> أمر شراء جديد</h4>
                                            <div class="row">
                                                <div class="col-md-6" style="border-left: 6px solid #28d094;
                                    height: 140px;">
                                                    <div class="form-group">
                                                        <div class="text-bold-600 font-medium-2">
                                                            اختر المورد
                                                        </div>
                                                        <select class="select2-rtl form-control"
                                                            data-placeholder="إختر المورد..." name="supplier_id"
                                                            id="supplier_id" required>
                                                            <option></option>
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">
                                                                    {{ $supplier->supplier_name }}
                                                                    @if (isset($supplier->supplier_company))
                                                                        - {{ $supplier->supplier_company }}
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="text-bold-600 font-medium-2">
                                                            مورد جديد
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="new_supplier_name"
                                                                id="new_supplier_name" placeholder="اسم المورد"
                                                                onblur="return chooseSupplierType()" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="new_supplier_mobile" id="new_supplier_mobile"
                                                                placeholder="موبايل المورد"
                                                                onblur="return chooseSupplierType()" />
                                                            <small id="supplierHelp" class="text-danger"
                                                                style="display: none">
                                                                هذا الرقم مسجل بالفعل
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="base-tab11" data-toggle="tab"
                                                    aria-controls="tab11" href="#tab11" aria-expanded="true">الخصم</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13"
                                                    href="#tab13" aria-expanded="false">الشحن</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="base-tab14" data-toggle="tab" aria-controls="tab14"
                                                    href="#tab14" aria-expanded="false">الضريبة</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                                aria-labelledby="base-tab11">
                                                <div class="row">
                                                    <div class="col-md-4" id="dis_per">
                                                        <div class="form-group">
                                                            <label for="projectinput3">الخصم</label>
                                                            <input type="number" id="curr_per" class="form-control"
                                                                placeholder="" name="discount_percentage" value="0" min="0"
                                                                max="100" onblur="return calculateDiscount(1)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="display: none" id="dis_amount">
                                                        <div class="form-group">
                                                            <label for="projectinput3">الخصم</label>
                                                            <input type="number" id="curr_amount" class="form-control"
                                                                placeholder="" name="discount_amount" value="0" min="0"
                                                                onblur="return calculateDiscount(2)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="projectinput3">النوع</label>

                                                            <select class="form-control"
                                                                onchange="return changeDisType(this)">
                                                                <option value="percent">نسبة مئوية (%)</option>
                                                                <option value="fixed">المبلغ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput3">مصاريف الشحن</label>
                                                            <input type="number" id="shipping_fees" class="form-control"
                                                                placeholder="" name="shipping_fees" value="0"
                                                                onblur="return updateShipping()" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput3">نسبة الضريبة</label>
                                                            <input type="number" id="tax_fees" class="form-control"
                                                                placeholder="" name="tax" value="0"
                                                                onblur="return updateTax()" required>
                                                        </div>
                                                    </div>
                                                </div>

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
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered" id="myTable" style="overflow: hidden;">
                                                <thead class="bg-yellow bg-lighten-4">
                                                    <tr>
                                                        <th style="width: 250px">البند</th>
                                                        <th>الوصف</span>
                                                            <span class="tooltip">
                                                                <a href="#" tabindex="-1"><img
                                                                        src="/css/images/question-ar.png"
                                                                        class="tips-image"></a>
                                                            </span>
                                                        </th>
                                                        <th>سعر الوحدة</th>
                                                        <th>الكمية</th>
                                                        <th>المجموع</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="row_1">
                                                        <td>
                                                            <div class="form-group product_sel">
                                                                <select class="select2-rtl form-control"
                                                                    data-placeholder="إختر المنتج" name="product[1][id]"
                                                                    required>
                                                                    <option></option>
                                                                    @foreach ($products as $product)
                                                                        <option value="{{ $product->id }}">
                                                                            {{ $product->product_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="product_input"
                                                                name="product[1][desc]" /></td>
                                                        <td><input type="number" class="product_input" id="p_p_1"
                                                                name="product[1][price]" onblur="return reCalculate(1)"
                                                                oninput="return numbersOnly(this)" required /></td>
                                                        <td><input type="number" class="product_input" id="p_q_1"
                                                                name="product[1][qty]" onblur="return reCalculate(1)"
                                                                oninput="return numbersOnly(this)" value="0" required />
                                                        </td>
                                                        <td>
                                                            <span id="tot_1">0</span> ج.م
                                                        </td>
                                                        <td></td>
                                                    </tr>





                                                    

                                                    <tr id="hidden-row-1" style="display: none">
                                                        <td colspan="4" class="text-right"><strong> الخصم (النسبة)[<span
                                                            id="discount_percentage"
                                                            style="color: goldenrod">0</span>%]</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span
                                                            id="discount_percentage_amount">0</span></code>&nbsp;ج.م
                                                        </td>
                                                        <td></td>
                                                    </tr>

                                                    <tr id="hidden-row-2" style="display: none">
                                                        <td colspan="4" class="text-right"><strong>الخصم (المبلغ)</strong>
                                                        </td>
                                                        <td id="TotalValue" class="text-left"><code><span
                                                            id="discount_amount">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                    </tr>
                                                    
                                                    <tr id="hidden-row-3" style="display: none">
                                                        <td colspan="4" class="text-right"><strong>الشحن</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span
                                                        id="shipping">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr id="hidden-row-4" style="display: none">
                                                        <td colspan="4" class="text-right"><strong> الضريبة[<span id="tax"
                                                            style="color: goldenrod">0</span>%]</strong></td>
                                                        <td class="text-left"><code><span
                                                            id="tax_amount">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2" style="border-style: none !important;">
                                                            <div>
                                                                <button type="button" onclick="addField()"
                                                                    class="add-row btn m-b-xs btn-sm btn-success btn-addon btn-blue">
                                                                    <i class="la la-plus"></i>
                                                                    إضافة بند
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td colspan="2" class="text-right"
                                                            style="border-style: none !important;"><strong>المبلغ</strong>
                                                        </td>
                                                        <td class="text-left" style="border-style: none !important;">
                                                            <code><span id="total_after_all">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><strong>المبلغ الإجمالي</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span
                                                                    id="total_after_all2">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <fieldset class="form-group">
                                            <p class="text-muted">الشروط / الملاحظات</p>
                                            <textarea class="form-control" name="purchase_note" rows="5"
                                                id="terms-conditions"></textarea>
                                        </fieldset>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>






        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {{-- <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button> --}}
                            <button type="submit" class="btn btn-outline-primary btn-block" id="saveBtn"><i
                                    class="la la-check-square-o"></i> إضافة</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        </form>
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
    <script src="{{ asset('theme/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js') }}"></script>

    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/editors/editor-ckeditor.min.js') }}"></script> --}}
    <script>
        $(document).on("keyup", ".dof3aSum", function() {
            var sum = 0;
            var total = $('#total_after_all2').text();
            total = parseInt(total);
            $(".dof3aSum").each(function() {
                sum += +$(this).val();
            });
            if (total != sum) {
                $('#dof3aError').css('display', 'block');
                $('#saveBtn').attr('disabled', true);
            } else {
                $('#dof3aError').css('display', 'none');
                $('#saveBtn').attr('disabled', false);


            }
        });

        CKEDITOR.ClassicEditor.create(document.querySelector('#terms-conditions')).catch(error => {
            console.error(error);
        });




        function updateTax() {
            newTax = $('#tax_fees').val();
            if ($('#tax_fees').val().length === 0) {
                newTax = 0;
            }
            if (newTax > 0) {
                $('#hidden-row-4').show();
            } else {
                $('#hidden-row-4').hide();
            }
            
            var getDiscountAmount_1 = $('#discount_percentage_amount').text();
            var getDiscountAmount_2 = $('#discount_amount').text();
            getDiscountAmount_1 = parseInt(getDiscountAmount_1);
            getDiscountAmount_2 = parseInt(getDiscountAmount_2);

            // the tax is applyed after the discount

            var currentInvoiceTotal = $("#total_after_all").text();
            currentInvoiceTotal = parseInt(currentInvoiceTotal) - getDiscountAmount_1 - getDiscountAmount_2;
            
            var newInvoiceTotal = currentInvoiceTotal + (currentInvoiceTotal * (newTax / 100));
            var taxAmount = newInvoiceTotal - currentInvoiceTotal  ;
            taxAmount = Math.round(taxAmount);
            $('#tax_amount').text(taxAmount);

            $('#tax').html(newTax);
            updateTotal();
        }


        // function numbersOnly(input){
        //     input.value = input.value.replace(/[^0-9.]/g, '');
        //     input.value = input.value.replace(/(\..*)\./g, '$1');
        // }


        function chooseSupplierType() {
            newSupplierName = $('#new_supplier_name').val().length;
            newSupplierMobile = $('#new_supplier_mobile').val().length;
            OldSupplierSelect = $('#supplier_id').val().length;
            if (newSupplierName > 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = {
                    supplier_mobile: $('#new_supplier_mobile').val(),
                };
                var type = "POST";
                var ajaxurl = "{{ route('suppliers.checksupplier') }}";
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.data > 0) {
                            $('#supplierHelp').css('display', 'block');
                            $('#new_supplier_mobile').addClass('is-invalid');
                            $('#new_supplier_mobile').removeClass('is-valid');
                            $("#saveBtn").prop("disabled", true);
                        } else {
                            $('#supplierHelp').css('display', 'none');
                            $('#new_supplier_mobile').addClass('is-valid');
                            $('#new_supplier_mobile').removeClass('is-invalid');
                            $("#saveBtn").prop("disabled", false);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });



                $("#supplier_id").attr({
                    "required": false
                });
                $("#new_supplier_name").attr({
                    "required": true
                });
                $("#new_supplier_mobile").attr({
                    "required": true
                });
            } else {
                $("#supplier_id").attr({
                    "required": true
                });
                $("#new_supplier_name").attr({
                    "required": false
                });
                $("#new_supplier_mobile").attr({
                    "required": false
                });
            }
        }



        function payNow(row) {
            if ($('#pay_now_' + row + ':visible').length == 0) {
                $('#pay_now_' + row).show();
            } else {
                $('#pay_now_' + row).hide();
            }
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
            //get shipping
            var getShipping = $('#shipping').text();
            getShipping = parseInt(getShipping);
            //get Tax
            var getTax = $('#tax_amount').text();
            getTax = parseInt(getTax);
            //add them all
            var invoiceTotal = getSubTotal + getShipping + getTax - getDiscountAmount_1 - getDiscountAmount_2;
            $('#total_after_all2').text(invoiceTotal);
            $('#totalToSave').val(invoiceTotal);

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


        function changeDisType(type) {
            if (type.value == 'fixed') {
                $('#dis_per').hide();
                $('#dis_amount').show();
            } else {
                $('#dis_amount').hide();
                $('#dis_per').show();
            }
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
                discount_amount = Math.round(discount_amount);
                $('#discount_percentage').text(theValue);
                $('#discount_percentage_amount').text(discount_amount);
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
            }
            updateTotal();
        }


        function updateShipping() {
            newShipping = $('#shipping_fees').val();
            if ($('#shipping_fees').val().length === 0) {
                newShipping = 0;
            }
            if (newShipping > 0) {
                $('#hidden-row-3').show();
            } else {
                $('#hidden-row-3').hide();
            }
            $('#shipping').html(newShipping);
            updateTotal();
        }

        function reCalculate(rowNum) {
            var oldRowTotal = $("#tot_" + rowNum).text();
            oldRowTotal = parseInt(oldRowTotal);
            var price = $("#p_p_" + rowNum).val();
            var qty = $("#p_q_" + rowNum).val();
            var rowTotal = price * qty;
            $('#tot_' + rowNum).text(rowTotal);
            var currentTotal = $("#total_after_all").text();
            currentTotal = parseInt(currentTotal);
            var newTotal = currentTotal - oldRowTotal;
            newTotal = newTotal + rowTotal;
            //Subtotal
            $('#total_after_all').text(newTotal);

            updateDiscount();
            updateShipping();
            updateTax();

            updateTotal();
        }


        function delRow(rowNum) {
            var oldRowTotal = $("#tot_" + rowNum).text();
            oldRowTotal = parseInt(oldRowTotal);
            var currentTotal = $("#total_after_all").text();
            currentTotal = parseInt(currentTotal);
            var newTotal = currentTotal - oldRowTotal;
            //sub total
            $('#total_after_all').text(newTotal);
            updateDiscount();
            updateShipping();
            updateTax();

            updateTotal();
            $("#tot_" + rowNum).closest('tr').remove();

        }


        $('#payment_method').on('change', function() {
            if (this.value == 'later') {
                //$('#init_box').hide();
                $('#other_box').hide();
                $('#later_box').show();

            } else if (this.value == 'cash' || this.value == 'visa' || this.value == 'bankTransfer') {
                //$('#init_box').hide();
                $('#later_box').hide();
                $('#other_box').show();
            } else {
                $('#later_box').hide();
                $('#other_box').hide();
                $('#init_box').show();
            }
        });


        function addDofaa() {

            var dofaaTable = document.getElementById("dofaaTable");
            var currentIndex = dofaaTable.rows.length;
            var currentRow = dofaaTable.insertRow(-1);


            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML =
                '<div class="form-group"><input type="number" id="" class="form-control dof3aSum" placeholder="أدخل المبلغ" name="later[' +
                currentIndex + '][amount]" value="0" required></div>';

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML =
                '<fieldset class="form-group"><input type="date" class="form-control" id="date"  name="later[' +
                currentIndex +
                '][date]"></fieldset><fieldset class="form-group"><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[' +
                currentIndex + '][notes]"></textarea></fieldset>';

            var currentCell = currentRow.insertCell(-1);
            //currentCell.innerHTML = '<fieldset class="checkboxsas"><label><input type="checkbox" name="later['+currentIndex+'][paid]">مدفوعه</label></fieldset>';
            //currentCell.innerHTML = '<fieldset class="checkboxsas"><label>مدفوعه<input type="checkbox" name="later['+currentIndex+'][paid]" onchange="return laterPaid('+currentIndex+')"></label></fieldset><div id="pay_now_'+currentIndex+'" style="display:none;"><div class="form-group"><div class="label">رقم العملية في الخزنة:</div><input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later['+currentIndex+'][safe_payment_id]"></div><div class="form-group"><label for="projectinput3">خصمت من:</label><select class="select2-rtl form-control" data-placeholder="تعديل" name="later['+currentIndex+'][safe_id]"><option></option> @foreach ($safes as $safe) <option value="{{ $safe->id }}">{{ $safe->safe_name }}</option> @endforeach </select></div></div>';
            currentCell.innerHTML = '<fieldset class="checkboxsas"><label> دفع الان<input type="checkbox" name="later[' +
                currentIndex + '][paynow]" onchange="return payNow(' + currentIndex +
                ')"></label></fieldset><div class="form-group" style="display:none;" id="pay_now_' + currentIndex +
                '"><label for="projectinput3">خصم من:</label><br><select class="select2-rtl form-control" data-placeholder="الخزنة" id="sel_xx_' +
                currentIndex + '" name="later[' + currentIndex +
                '][safe_id]"><option></option>@foreach ($safes as $safe)<option value="{{ $safe->id }}">{{ $safe->safe_name }}</option>@endforeach</select></div>';
            $('#sel_xx_' + currentIndex).select2();
        }




        function addField(argument) {
            var myTable = document.getElementById("myTable");
            var currentIndex = myTable.rows.length;
            var currentRow = myTable.insertRow(myTable.rows.length - 6);

            var product_id = document.createElement("input");
            // product_id.setAttribute("name", "product_id[" + currentIndex + "]");
            product_id.setAttribute("name", "product[" + currentIndex + "][id]");
            product_id.setAttribute("class", "product_input");

            var product_desc = document.createElement("input");
            product_desc.setAttribute("name", "product[" + currentIndex + "][desc]");
            product_desc.setAttribute("class", "product_input");

            var product_price = document.createElement("input");
            product_price.setAttribute("name", "product[" + currentIndex + "][price]");
            product_price.setAttribute("class", "product_input");
            product_price.setAttribute("type", "number");
            product_price.setAttribute("id", "p_p_" + currentIndex);
            product_price.setAttribute("oninput", "return numbersOnly(this)");
            product_price.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
            product_price.setAttribute("required", "required");


            var product_qty = document.createElement("input");
            product_qty.setAttribute("name", "product[" + currentIndex + "][qty]");
            product_qty.setAttribute("class", "product_input");
            product_qty.setAttribute("type", "number");
            product_qty.setAttribute("id", "p_q_" + currentIndex);
            product_qty.setAttribute("oninput", "return numbersOnly(this)");
            product_qty.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
            product_qty.setAttribute("value", "0");
            product_qty.setAttribute("required", "required");

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex +
                '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[' + currentIndex +
                '][id]" required><option></option> @foreach ($products as $product) <option value="{{ $product->id }}">{{ $product->product_name }}</option>@endforeach</select></div>';
            $('#sel_x_' + currentIndex).select2();

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(product_desc);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(product_price);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(product_qty);

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML = ' <span id="tot_' + currentIndex + '">0</span> ج.م';

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML = '<center><button type="button" class="btn btn-danger btn-sm" onclick="return delRow(' +
                currentIndex + ')" style="vertical-align:center">X</button></center>';
        }

        $(document).ready(function() {

            $('#hasDelivered').change(function() {

                if ($('#hasDelivered').prop('checked')) {
                    $('#delivery_info').show();
                    $('#delDate').prop('required', true);
                    $('#delBranch').prop('required', true);
                } else {
                    $('#delivery_info').hide();
                    $('#delDate').prop('required', false);
                    $('#delBranch').prop('required', false);
                }

            });

            $('#hasPaid').change(function() {

                if ($('#hasPaid').prop('checked')) {
                    $('#notPaid').hide();
                    $('#yesPaid').show();
                    //$('#yesPaid2').show();
                    $('#other_box').hide();
                    $('#later_box').hide();
                    $('#payment_method').prop('required', false);
                    $('#safe_payment_id').prop('required', true);




                } else {
                    $('#yesPaid').hide();
                    $('#yesPaid2').hide();
                    $('#notPaid').show();
                    $('#payment_method').att
                    $('#payment_method').prop('required', true);
                    $('#safe_payment_id').prop('required', false);


                }
            });
        });

    </script>

@endsection
