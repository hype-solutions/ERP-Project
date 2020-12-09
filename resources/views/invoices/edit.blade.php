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

<style>
    .product_input{
    width: 100%;
    padding: 0 4px;
    overflow: hidden;
    line-height: 17px;
    height: 40px;
    resize: none;
    background: 0 0;
    margin: 0;
    font-size: 12px;
    border:none;
    }
    .product_sel{
        margin-bottom: 0 !important;
    }
    #myTable tr td{
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

<form method="POST" action="{{route('invoices.update',$invoice->id)}}">
      @csrf
      @method('patch')


      <input type="hidden" name="sold_by" value="{{ $user_id }}" />
      <input type="hidden" name="invoice_total" id="totalToSave" value="0" />

  <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-flag"></i> فاتورة جديدة</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         اختر الفرع
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر الفرع..." name="branch_id" id="branch_id"  required>
                                            <option value="{{$invoice->branch_id}}">{{$invoice->branch->branch_name}}</option>
                                            @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         اختر العميل
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر العميل..." name="customer_id"  required>
                                            <option value="{{$invoice->customer_id}}">{{$invoice->customer->customer_name}}</option>
                                            @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                            @endforeach
                                        </select>
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

                    <fieldset class="form-group">
                        <p class="text-muted">الشروط /  الملاحظات</p>
                    <textarea class="form-control" name="invoice_note" rows="4"  >{{$invoice->invoice_note}}</textarea>
                    </fieldset>


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
                                            <a href="#" tabindex="-1"><img src="/css/images/question-ar.png" class="tips-image"></a>
                                        </span>
                                    </th>
                                    <th>سعر الوحدة</th>
                                    <th>الكمية</th>
                                    <th>المجموع</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($currentProducts as $key => $item)
                                <tr id="row_{{$key+1}}">
                                    <td>
                                        <div class="form-group product_sel">
                                            <select class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[{{$key+1}}][id]" onchange="return getProductInfo(this,{{$key+1}})" required>
                                                <option value="{{$item->product_id}}">{{$item->product->product_name}}</option>
                                                @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </td>
                                    <td><input type="text" class="product_input" name="product[{{$key+1}}][desc]" value="{{$item->product_desc}}"/></td>
                                    <td><input type="number" class="product_input" id="p_p_{{$key+1}}" name="product[{{$key+1}}][price]"  value="{{$item->product_price}}" onblur="return reCalculate({{$key+1}})" min="0"/></td>
                                    <td><input type="number" class="product_input" id="p_q_{{$key+1}}" name="product[{{$key+1}}][qty]"  value="{{$item->product_qty}}" onblur="return reCalculate({{$key+1}})"  min="0"/></td>
                                    <td>
                                        <span id="tot_{{$key+1}}">0</span> ج.م
                                    </td>
                                    <td><center><button type="button" class="btn btn-danger btn-sm" onclick="return delRow({{$key+1}})" style="vertical-align:center">X</button></center></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" style="border-style: none !important;">
                                        <div>
                                            <button type="button" onclick="addField()" class="add-row btn m-b-xs btn-sm btn-success btn-addon btn-blue" id="addingRowBtn">
                                                <i class="la la-plus"></i>
                                                إضافة بند
                                            </button>
                                        </div>
                                    </td>
                                    <td colspan="2" class="text-right"  style="border-style: none !important;"><strong>الإجمالي</strong></td>
                                    <td class="text-left"  style="border-style: none !important;"><code><span id="total_after_all">0</span></code>&nbsp;ج.م</td>
                                    <td></td>
                                </tr>
                                <tr id="hidden-row-1" style="display: none">
                                    <td colspan="4" class="text-right"><strong> الخصم (النسبة)[<span id="discount_percentage" style="color: goldenrod">0</span>%]</strong></td>
                                    <td id="TotalValue" class="text-left"><code><span id="discount_percentage_amount">0</span></code>&nbsp;ج.م</td>
                                    <td></td>
                                 </tr>
                                 <tr id="hidden-row-2" style="display: none">
                                    <td colspan="4" class="text-right"><strong>الخصم (المبلغ)</strong></td>
                                    <td id="TotalValue" class="text-left"><code><span id="discount_amount">0</span></code>&nbsp;ج.م</td>
                                    <td></td>
                                 </tr>
                                 <tr id="hidden-row-3" style="display: none">
                                    <td colspan="4" class="text-right"><strong>الشحن</strong></td>
                                    <td id="TotalValue" class="text-left"><code><span id="shipping">0</span></code>&nbsp;ج.م</td>
                                    <td></td>
                                 </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>الإجمالي</strong></td>
                                    <td id="TotalValue" class="text-left"><code><span id="total_after_all2">0</span></code>&nbsp;ج.م</td>
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
    <div class="col-md-4">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-top-border no-hover-bg">
                      <li class="nav-item">
                        <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#tab11" aria-expanded="true">الخصم</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13" aria-expanded="false">الشحن</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
                         <div class="row">
                              <div class="col-md-4"  id="dis_per">
                                  <div class="form-group">
                                      <label for="projectinput3">الخصم</label>
                                      <input type="number" id="curr_per" class="form-control" placeholder="" name="discount_percentage" value="{{$invoice->discount_percentage}}" min="0" max="100" onblur="return calculateDiscount(1)">
                                  </div>
                              </div>
                              <div class="col-md-4" style="display: none" id="dis_amount">
                                <div class="form-group">
                                    <label for="projectinput3">الخصم</label>
                                    <input type="number" id="curr_amount" class="form-control" placeholder="" name="discount_amount" value="{{$invoice->discount_amount}}" min="0" onblur="return calculateDiscount(2)">
                                </div>
                            </div>
                              <div class="col-md-8">
                                  <div class="form-group">
                                      <label for="projectinput3">النوع</label>

                                      <select class="form-control" onchange="return changeDisType(this)">
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
                                      <input type="number" id="shipping_fees" class="form-control" placeholder="" name="shipping_fees" value="{{$invoice->shipping_fees}}" onblur="return updateShipping()" required>
                                  </div>
                              </div>
                          </div>

                      </div>

                    </div>
              </div>
            </div>
        </div>
    </div>

<div class="col-md-8">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if($invoice->already_paid)
                    <h3>تم الدفع</h3>
                    @else
                    <div >
                        <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button onclick="addDofaa()" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i></button></h4>
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dofaaTable">
                            <thead>
                                <tr>
                                    <th>المبلغ</th>
                                    <th>تاريخ الإستحقاق</th>
                                    <th>تم دفعها؟</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laterDates as $key2 => $item)
                                <tr>
                                    <th scope="row">
                                        <div class="form-group">
                                            <input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later[{{$key2+1}}][amount]" value="{{$item->amount}}">
                                        </div>
                                    </th>
                                    <td>
                                        <fieldset class="form-group">
                                        <input type="date" class="form-control" id="date"   name="later[{{$key2+1}}][date]"  value="{{$item->date}}">
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <div class="label">الملاحظات</div>
                                        <textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[{{$key2+1}}][notes]">{{$item->notes}}</textarea>
                                    </fieldset>
                                </td>

                                    <td>


                                        @if ($item->paid == 'Yes')
                                        <fieldset class="checkboxsas">
                                            <label>
                                               تم الدفع
                                              <input type="checkbox" name="" onclick="return false" checked>
                                            </label>
                                        </fieldset>
                                        <div class="form-group">
                                            <div class="label">رقم العملية في الخزنة:</div>
                                            <input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[1][safe_payment_id]" readonly>
                                        </div>

                                        @else
                                        <fieldset class="checkboxsas">
                                            <label>
                                                دفع الان
                                              <input type="checkbox" name="later[1][paynow]">
                                            </label>
                                        </fieldset>

                                        @endif

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        </div>
                    </div>
                    @endif
                    {{-- <div class="col-md-6" style="display: none">
                         <fieldset class="checkboxsas">
                            <label>
                              <input type="checkbox" name="already_paid" id="hasPaid">
                              هل تم الدفع بالفعل؟
                                          </label>
                        </fieldset>

                    </div> --}}
                    {{-- <div class="col-md-12" id="notPaid">
                        <div class="form-group">
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="none">إختر طريقة الدفع</option>
                            <option value="cash">كاش</option>
                            <option value="visa">فيزا</option>
                            <option value="later">اجل (دفعات)</option>
                            <option value="bankTransfer">تحويل بنكي</option>
                        </select>
                    </div>
                    </div> --}}
                    {{-- <div class="col-md-3" style="display: none" id="yesPaid">
                        <div class="form-group">
                            <div class="label">رقم العملية في الخزنة</div>
                        <input type="text" class="form-control" name="safe_payment_id"/>
                    </div>
                    </div>
                    <div class="col-md-3" style="display: none" id="yesPaid2">
                        <div class="form-group">
                        <label for="projectinput3">أضيفت الى:</label>
                        <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id_if_paid">
                            <option></option>
                            @foreach ($safes as $safe)
                            <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-12" id="other_box" style="display: none">
        <div class="card">
            <div class="card-body">

        <div class="div">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="projectinput3">إختر الخزنة التي سيتم التوريد بها</label>
                    <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id_not_paid">
                        <option></option>
                        @foreach ($safes as $safe)
                        <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </div>

        </div>




            </div>
        </div>
    </div> --}}

    <div class="col-md-12" id="later_box" style="display: none">
        <div class="card">
            <div class="card-body">





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
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> حفظ</button>

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

<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
    <script>

$(document).ready(function () {

    for (let index = 1; index < {{$key+2}}; index++) {
    reCalculate(index);
}




     currentProductIds = [];
$('#hasPaid').change(function () {

    if ($('#hasPaid').prop('checked')) {
        $('#notPaid').hide();
        $('#yesPaid').show();
        $('#yesPaid2').show();
        $('#other_box').hide();
        $('#later_box').hide();



        }else{
        $('#yesPaid').hide();
        $('#yesPaid2').hide();
        $('#notPaid').show();

    }
    });
    });

function getProductInfo(product,row){

    var branch_id = 1;

    var get_branch_id = $('#branch_id').val();

      if(get_branch_id > 0 ){
        branch_id = get_branch_id;
          }else{
             branch_id = 1;
        }

    //ajax call to get product available amount in this branch and selling price
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            branch: branch_id,
            product: product.value,
        };
        var type = "POST";
        var ajaxurl = "{{route('products.fetchQty')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                $("#addingRowBtn").prop("disabled",true);
            },
            success: function (data) {

               // $("#p_q_1").val(data.amount);
                 $("#p_q_"+row).attr({"max" : data.amount });
                 $("#p_q_"+row).attr({"placeholder" : "متاح: "+data.amount });
            },
            error: function (data) {
                console.log(data);
            }
        });

        var ajaxurl = "{{route('products.fetchPrice')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#p_p_"+row).val(data.price);
                reCalculate(row);
                $("#addingRowBtn").prop("disabled",false);
            },
            error: function (data) {
                console.log(data);
            }
        });

//currentProductIds.push(product.value);

// console.log(currentProductIds);

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
//add them all
var invoiceTotal = getSubTotal + getShipping - getDiscountAmount_1 - getDiscountAmount_2;
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
  discount_amount = Math.floor(discount_amount);
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
updateTotal();
$("#tot_" + rowNum).closest('tr').remove();

//currentProductIds.pop(1);
}


$('#payment_method').on('change', function() {
if (this.value == 'later') {
  //$('#init_box').hide();
  //$('#other_box').hide();
  $('#later_box').show();
  $('#hasPaid').prop( "checked", false );

} else if (this.value == 'cash' || this.value == 'visa' || this.value == 'bankTransfer') {
  //$('#init_box').hide();
  $('#later_box').hide();
  //$('#other_box').show();
  $('#hasPaid').prop( "checked", true );
} else {
  $('#later_box').hide();
  //$('#other_box').hide();
  $('#init_box').show();
  $('#hasPaid').prop( "checked", false );
}
});


function addDofaa()
{

var dofaaTable = document.getElementById("dofaaTable");
var currentIndex = dofaaTable.rows.length;
var currentRow = dofaaTable.insertRow(-1);


var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<div class="form-group"><input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later['+currentIndex+'][amount]" value="0" required></div>';

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<fieldset class="form-group"><input type="date" class="form-control" id="date" value="2011-08-19" name="later['+currentIndex+'][date]"></fieldset><fieldset class="form-group"><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later['+currentIndex+'][notes]"></textarea></fieldset>';

var currentCell = currentRow.insertCell(-1);
//currentCell.innerHTML = '<fieldset class="checkboxsas"><label><input type="checkbox" name="later['+currentIndex+'][paid]">مدفوعه</label></fieldset>';
//currentCell.innerHTML = '<fieldset class="checkboxsas"><label>مدفوعه<input type="checkbox" name="later['+currentIndex+'][paid]" onchange="return laterPaid('+currentIndex+')"></label></fieldset><div id="later_dates_'+currentIndex+'" style="display:none;"><div class="form-group"><div class="label">رقم العملية في الخزنة:</div><input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later['+currentIndex+'][safe_payment_id]"></div><div class="form-group"><label for="projectinput3">خصمت من:</label><select class="select2-rtl form-control" data-placeholder="تعديل" name="later['+currentIndex+'][safe_id]"><option></option> @foreach ($safes as $safe) <option value="{{$safe->id}}">{{$safe->safe_name}}</option> @endforeach </select></div></div>';
currentCell.innerHTML = '<fieldset class="checkboxsas"><label>دفع الان <input type="checkbox" name="later['+currentIndex+'][paynow]"></label></fieldset>'

}




function addField(argument) {

   // requestData = ['1'];
    //var requestData = JSON.stringify(currentProductIds[0]);
//var requestData = JSON.stringify(myArr);

    //console.log(requestData);
//     $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
//             }
//                         });
//         // var formData = {
//         //     other_ids: currentProductIds.value,
//         // };
//         var type = "POST";
//         var ajaxurl = "{{--route('invoices.getOtherProducts')--}}";
//         $.ajax({
//             type: type,
//             url: ajaxurl,
//             data: {
//                 other_ids : currentProductIds
//             },
//             dataType: "json",
//             beforeSend: function () {
//                 $("#addingRowBtn").prop("disabled",true);
//                 $("#sel_x_"+ currentIndex).prop("disabled",true);
//   },
//   complete: function () {
//     $("#addingRowBtn").prop("disabled",false);
//     $("#sel_x_"+ currentIndex).prop("disabled",false);

//   },
//             success: function (data) {

//                 for (var i = 0; i < data.length; i++) {
//                     $("#sel_x_"+ currentIndex).append("<option></option>");
//                     $("#sel_x_"+ currentIndex).append("<option value='"+ data[i].id +"'>"+ data[i].product_name +"</option>");


//                 }
//             },
//             error: function (data) {
//                 console.log(data);
//             }
//         });



var myTable = document.getElementById("myTable");
var currentIndex = myTable.rows.length;
var currentRow = myTable.insertRow(myTable.rows.length - 5);

var product_id = document.createElement("input");
// product_id.setAttribute("name", "product_id[" + currentIndex + "]");
product_id.setAttribute("name", "product[" + currentIndex + "][id]");
product_id.setAttribute("class", "product_input");

var product_desc = document.createElement("input");
product_desc.setAttribute("name", "product[" + currentIndex + "][desc]");
product_desc.setAttribute("class", "product_input");

var product_price = document.createElement("input");
product_price.setAttribute("name", "product[" + currentIndex + "][price]");
product_price.setAttribute("type", "number");
product_price.setAttribute("min", "0");
product_price.setAttribute("class", "product_input");
product_price.setAttribute("id", "p_p_" + currentIndex);
product_price.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");

var product_qty = document.createElement("input");
product_qty.setAttribute("name", "product[" + currentIndex + "][qty]");
product_price.setAttribute("type", "number");
product_price.setAttribute("min", "0");
product_qty.setAttribute("class", "product_input");
product_qty.setAttribute("id", "p_q_" + currentIndex);
product_qty.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
product_qty.setAttribute("placeholder", "0");

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required onchange="return getProductInfo(this,'+currentIndex+')"><option></option> @foreach ($products as $product) <option value="{{$product->id}}">{{$product->product_name}}</option>  @endforeach</select></div>';

//currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required onchange="return getProductInfo(this,'+currentIndex+')"> </select></div>';


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
currentCell.innerHTML = '<center><button type="button" class="btn btn-danger btn-sm" onclick="return delRow(' + currentIndex + ')" style="vertical-align:center">X</button></center>';
}

        </script>

 @endsection

