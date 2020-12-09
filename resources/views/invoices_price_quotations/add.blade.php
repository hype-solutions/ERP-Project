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

<form method="POST" action="{{route('invoicespricequotations.adding')}}">
      @csrf


      <input type="hidden" name="sold_by" value="{{ $user_id }}" />
      <input type="hidden" name="quotation_total" id="totalToSave" value="0" />

  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-flag"></i> عرض سعر جديد</h4>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         اختر العميل
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر العميل..." name="customer_id"   required>
                                            <option></option>
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

    <div class="col-md-6">
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
                                        <input type="number" id="curr_per" class="form-control" placeholder="" name="discount_percentage" value="0" min="0" max="100" onblur="return calculateDiscount(1)">
                                    </div>
                                </div>
                                <div class="col-md-4" style="display: none" id="dis_amount">
                                  <div class="form-group">
                                      <label for="projectinput3">الخصم</label>
                                      <input type="number" id="curr_amount" class="form-control" placeholder="" name="discount_amount" value="0" min="0" onblur="return calculateDiscount(2)">
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
                                        <input type="number" id="shipping_fees" class="form-control" placeholder="" name="shipping_fees" value="0" onblur="return updateShipping()" required>
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
                                <tr id="row_1">
                                    <td>
                                        <div class="form-group product_sel">
                                            <select class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[1][id]" id="sel_x_1" required>
                                                <option></option>
                                                @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </td>
                                    <td><input type="text" class="product_input" name="product[1][desc]"/></td>
                                    <td><input type="number" class="product_input" id="p_p_1" name="product[1][price]" onblur="return reCalculate(1)" min="0"/></td>
                                    <td><input type="number" class="product_input" id="p_q_1" name="product[1][qty]" onblur="return reCalculate(1)" min="0" placeholder="0"/></td>
                                    <td>
                                        <span id="tot_1">0</span> ج.م
                                    </td>
                                    <td></td>
                                </tr>

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
    <div class="col-md-12">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">


                    <fieldset class="form-group">
                        <p class="text-muted">الشروط /  الملاحظات</p>
                        <textarea class="form-control" name="quotation_note" rows="4"  ></textarea>
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
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> إضافة</button>

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

    $('#sel_x_1').select2({allowClear: false,tags: true});


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
 currentCell.innerHTML = '<fieldset class="checkboxsas"><label>دفع الان <input type="checkbox" name="later['+currentIndex+'][paynow]"></label></fieldset>'

}




function addField(argument) {

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
currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required><option></option> @foreach ($products as $product) <option value="{{$product->id}}">{{$product->product_name}}</option>  @endforeach</select></div>';

//currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required onchange="return getProductInfo(this,'+currentIndex+')"> </select></div>';


$('#sel_x_' + currentIndex).select2({allowClear: false,tags: true});

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
