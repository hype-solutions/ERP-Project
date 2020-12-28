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
            <div class="content-header-left col-md-6 col-12 mb-2">
              <h3 class="content-header-title mb-0">أوامر الشراء</h3>
              <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('purchasesorders.list')}}">أوامر الشراء</a></li>
                    <li class="breadcrumb-item active">تعديل
                    </li>
                  </ol>
                </div>
              </div>
            </div>

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

<form method="POST" action="{{route('purchasesorders.update',$purchaseOrder->id)}}">
      @csrf
      @method('patch')


      <input type="hidden" name="added_by" value="{{ $user_id }}" />
      <input type="hidden" name="purchase_total" id="totalToSave" value="0" />

  <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-flag"></i> تعديل أمر شراء رقم <button class="btn-dark" type="button">{{$purchaseOrder->id}}</button></h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         تغيير المورد
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر المورد..." name="supplier_id"   required>
                                            <option value="{{$purchaseOrder->supplier_id}}">{{$purchaseOrder->supplier->supplier_name}}</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
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
                    <textarea class="form-control" name="purchase_note" rows="5" id="terms-conditions">{{$purchaseOrder->purchase_note}}</textarea>
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
                                            <select class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[{{$key+1}}][id]" required>
                                                <option value="{{$item->product_id}}">{{$item->product->product_name}}</option>
                                                @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </td>
                                    <td><input type="text" class="product_input" name="product[{{$key+1}}][desc]" value="{{$item->product_desc}}"/></td>
                                    <td><input type="number" class="product_input" id="p_p_{{$key+1}}" name="product[{{$key+1}}][price]"  value="{{$item->product_price}}" onblur="return reCalculate({{$key+1}})" min="0" oninput="return numbersOnly(this)" required/></td>
                                    <td><input type="number" class="product_input" id="p_q_{{$key+1}}" name="product[{{$key+1}}][qty]"  value="{{$item->product_qty}}" onblur="return reCalculate({{$key+1}})"  min="0" oninput="return numbersOnly(this)" required/></td>
                                    <td>
                                        <span id="tot_{{$key+1}}">0</span> ج.م
                                    </td>
                                    <td><center><button type="button" class="btn btn-danger btn-sm" onclick="return delRow({{$key+1}})" style="vertical-align:center">X</button></center></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" style="border-style: none !important;">
                                        <div>
                                            <button type="button" onclick="addField()" class="add-row btn m-b-xs btn-sm btn-success btn-addon btn-blue">
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
                                      <input type="number" id="curr_per" class="form-control" placeholder="" name="discount_percentage" value="{{$purchaseOrder->discount_percentage}}" min="0" max="100" onblur="return calculateDiscount(1)">
                                  </div>
                              </div>
                              <div class="col-md-4" style="display: none" id="dis_amount">
                                <div class="form-group">
                                    <label for="projectinput3">الخصم</label>
                                    <input type="number" id="curr_amount" class="form-control" placeholder="" name="discount_amount" value="{{$purchaseOrder->discount_amount}}" min="0" onblur="return calculateDiscount(2)">
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
                                      <input type="number" id="shipping_fees" class="form-control" placeholder="" name="shipping_fees" value="{{$purchaseOrder->shipping_fees}}" onblur="return updateShipping()" required>
                                  </div>

                              </div>
                          </div>

                      </div>

                    </div>
              </div>
            </div>
        </div>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                    <fieldset class="checkboxsas">
                        <label>
                          <input type="checkbox" name="already_delivered" id="hasDelivered" @if($purchaseOrder->already_delivered) checked  @endif @if($purchaseOrder->delivery_date) onclick="return false;"  @endif>
                         هل تم الإستلام بالفعل؟
                                      </label>
                    </fieldset>
                    <div class="div" id="delivery_info"  @if($purchaseOrder->already_delivered) style="display: block" @else style="display: none" @endif>
                        <fieldset class="form-group">
                            <div class="label">تاريخ الإستلام</div>
                            <input type="date" class="form-control" id="date"  name="delivery_date"  value="{{$purchaseOrder->delivery_date}}" @if($purchaseOrder->delivery_date) readonly  @endif>
                        </fieldset>
                        <div class="form-group">
                            <label> اختر الفرع (المخزن) المستلم:</label>


                            <select class="select2-rtl form-control" data-placeholder="إختر الفرع..." name="branch_id" @if($purchaseOrder->delivery_date) disabled  @endif>
                                @if($purchaseOrder->branch_id > 0)
                                <option value="{{$purchaseOrder->branch_id}}">{{$purchaseOrder->branch->branch_name}}</option>
                                @else
                                <option></option>
                                @endif
                                @foreach ($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
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
                    <div class="col-md-6">
                         <fieldset class="checkboxsas">
                            <label>
                              <input type="checkbox" name="already_paid" id="hasPaid" @if($purchaseOrder->already_paid) checked  @endif>
                              هل تم الدفع بالفعل؟
                                          </label>
                        </fieldset>

                    </div>
                    <div class="col-md-6" id="notPaid" @if($purchaseOrder->already_paid) style="display: none" @else style="display: block" @endif>
                        <div class="form-group">
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="{{$purchaseOrder->payment_method}}">تعديل طريقة الدفع</option>
                            <option value="cash">كاش</option>
                            <option value="visa">فيزا</option>
                            <option value="later">اجل (دفعات)</option>
                            <option value="bankTransfer">تحويل بنكي</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-3" @if($purchaseOrder->already_paid) style="display: block" @else style="display: none" @endif  id="yesPaid">
                        <div class="form-group">
                            <div class="label">رقم العملية في الخزنة</div>
                        <input type="text" class="form-control" name="safe_payment_id" value="{{$purchaseOrder->safe_payment_id}}"/>
                    </div>
                    </div>
                    <div class="col-md-3" @if($purchaseOrder->already_paid) style="display: block" @else style="display: none" @endif id="yesPaid2">
                        <div class="form-group">
                        <label for="projectinput3">خصمت من:</label>
                        <select class="select2-rtl form-control" data-placeholder="تعديل" name="safe_id_if_paid">
                            @if($purchaseOrder->already_paid)
                            <option value="{{$purchaseOrder->safe_id}}">{{$purchaseOrder->safe->safe_name}}</option>
                            @else
                            <option></option>
                            @endif
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
    <div class="col-md-12" id="other_box" style="display: none">
        <div class="card">
            <div class="card-body">

        <div class="div">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="projectinput3">اختر الخزنة التي سيتم خصم المبلغ منها</label>
                    <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id_not_paid">
                        <option></option>
                        @foreach ($safes2 as $safe)
                        <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            </div>

        </div>




            </div>
        </div>
    </div>

    <div class="col-md-12" id="later_box"  @if($purchaseOrder->payment_method == 'later') style="display: block" @else style="display: none" @endif >
        <div class="card">
            <div class="card-body">

        <div >
            <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button onclick="addDofaa()" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i></button></h4>
            <div class="table-responsive">
            <table class="table table-bordered   table-hover" id="dofaaTable">
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
                            <fieldset class="checkboxsas">
                                <label>
                                    مدفوعه
                                  <input type="checkbox" name="later[{{$key2+1}}][paid]" @if($item->paid != 'No') checked  @endif onchange="return laterPaid({{$key2+1}})">
                                </label>
                            </fieldset>


                            <div id="later_dates_{{$key2+1}}" @if($item->paid != 'No') style="display: block" @else style="display:none;"  @endif>
                            <div class="form-group">
                                <div class="label">رقم العملية في الخزنة:</div>
                                <input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[{{$key2+1}}][safe_payment_id]" value="{{$item->safe_payment_id}}">
                            </div>
                            <div class="form-group">
                                <label for="projectinput3">خصمت من:</label>
                                <select class="select2-rtl form-control" data-placeholder="تعديل" name="later[{{$key2+1}}][safe_id]">
                                    @if($item->paid  != 'No')
                                        @if($item->safe_id)
                                    <option value="{{$item->safe_id}}">{{$item->safe->safe_name}}</option>
                                        @else
                                        <option></option>
                                        @endif
                                    @else
                                    <option></option>
                                    @endif
                                    @foreach ($safes as $safe)
                                    <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>

                        </td>
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
<script src="{{ asset('theme/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js') }}"></script>

<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
    <script>


CKEDITOR.ClassicEditor.create( document.querySelector( '#terms-conditions' ) ).catch( error => {console.error( error );} );



function numbersOnly(input){
    input.value = input.value.replace(/[^0-9.]/g, '');
    input.value = input.value.replace(/(\..*)\./g, '$1');
}



function laterPaid(row){
    if($('#later_dates_'+row+':visible').length == 0)
        {
            $('#later_dates_'+row).show();
        }else{
            $('#later_dates_'+row).hide();
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


function addDofaa()
{

var dofaaTable = document.getElementById("dofaaTable");
var currentIndex = dofaaTable.rows.length;
var currentRow = dofaaTable.insertRow(-1);


var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<div class="form-group"><input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later['+currentIndex+'][amount]" value="0" required></div>';

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<fieldset class="form-group"><input type="date" class="form-control" id="date"  name="later['+currentIndex+'][date]"></fieldset><fieldset class="form-group"><label>الملاحظات</label><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later['+currentIndex+'][notes]"></textarea></fieldset>';

//var currentCell = currentRow.insertCell(-1);
//currentCell.innerHTML = '<fieldset class="checkboxsas"><label><input type="checkbox" name="later['+currentIndex+'][paid]">مدفوعه</label></fieldset>';


var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<fieldset class="checkboxsas"><label>مدفوعه<input type="checkbox" name="later['+currentIndex+'][paid]" onchange="return laterPaid('+currentIndex+')"></label></fieldset><div id="later_dates_'+currentIndex+'" style="display:none;"><div class="form-group"><div class="label">رقم العملية في الخزنة:</div><input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later['+currentIndex+'][safe_payment_id]"></div><div class="form-group"><label for="projectinput3">خصمت من:</label><select class="select2-rtl form-control" data-placeholder="تعديل" name="later['+currentIndex+'][safe_id]"><option></option> @foreach ($safes as $safe) <option value="{{$safe->id}}">{{$safe->safe_name}}</option> @endforeach </select></div></div>';



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
product_price.setAttribute("class", "product_input");
product_price.setAttribute("id", "p_p_" + currentIndex);
product_price.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
product_price.setAttribute("oninput", "return numbersOnly(this)");
product_price.setAttribute("required", "required");

var product_qty = document.createElement("input");
product_qty.setAttribute("name", "product[" + currentIndex + "][qty]");
product_qty.setAttribute("class", "product_input");
product_qty.setAttribute("id", "p_q_" + currentIndex);
product_qty.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
product_qty.setAttribute("value", "0");
product_qty.setAttribute("oninput", "return numbersOnly(this)");
product_qty.setAttribute("required", "required");


var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required><option></option> @foreach ($products as $product) <option value="{{$product->id}}">{{$product->product_name}}</option>@endforeach</select></div>';
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

$(document).ready(function () {

for (let index = 1; index < {{$key+2}}; index++) {
    reCalculate(index);
}



$('#hasDelivered').change(function () {

if ($('#hasDelivered').prop('checked')) {
    $('#delivery_info').show();
}else{
    $('#delivery_info').hide();
}

});



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
        </script>

 @endsection

