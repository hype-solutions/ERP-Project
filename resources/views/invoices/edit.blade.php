@extends('layouts.erp')
@section('title', 'تعديل فاتورة رقم #'.$invoice->id)

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
      .ck-editor__editable {
    min-height:50px;
}
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


      <input type="hidden" name="sold_by" value="{{ $invoice->loggedInUserId() }}" />
      <input type="hidden" name="invoice_total" id="totalToSave" value="0" />

  <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-flag"></i>تعديل فاتورة مبيعات رقم #{{$invoice->id}}</h4>
                            <div class="row">
                                @if($invoice->was_price_quotation)
                                <div class="col">
                                    <span style="color: green"><i><u>(محولة من عرض سعر رقم {{$invoice->price_quotation_id}})</u></i></span>
                                </div>
                                @endif
                                @if($invoice->invoice_paper_num)
                                <div class="col">
                                    <span style="color: green"><i><u>رقم الفاتورة الورقية: {{$invoice->invoice_paper_num}}</u></i></span>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         تغيير الفرع
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر الفرع..." name="branch_id" id="branch_id"  required>
                                            <option value="{{$invoice->branch_id}}">{{$invoice->branch->branch_name}}</option>
                                            @foreach ($invoice->allBranches() as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         تغيير العميل
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر العميل..." name="customer_id"  required>
                                            <option value="{{$invoice->customer_id}}">{{$invoice->customer->customer_name}}</option>
                                            @foreach ($invoice->allCustomers() as $customer)
                                            <option value="{{$customer->id}}">{{$customer->customer_name}}
                                                @if($customer->parent)
                                                - {{$customer->parent->customer_name}}
                                                @endif
                                                </option>
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
                    <textarea class="form-control" name="invoice_note" id="terms-conditions" rows="4"  >{{$invoice->invoice_note}}</textarea>
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
                                @foreach ($invoice->productsInInvoice as $key => $item)
                                <tr id="row_{{$key+1}}">
                                    <td>
                                        <div class="form-group product_sel">
                                            <select class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[{{$key+1}}][id]" onchange="return getProductInfo(this,{{$key+1}})" required>
                                                <option value="{{$item->product_id}}">{{$item->product->product_name}}</option>
                                                @foreach ($invoice->allProducts() as $product)
                                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </td>
                                    <td><input type="text" class="product_input" name="product[{{$key+1}}][desc]" value="{{$item->product_desc}}"  autocomplete="off"/></td>
                                    <td><input type="number" class="product_input" id="p_p_{{$key+1}}" name="product[{{$key+1}}][price]"  value="{{$item->product_price}}" onkeyup="return reCalculate({{$key+1}})" onmouseup="return reCalculate({{$key+1}})" min="0"  autocomplete="off"/>
                                        <input type="hidden" name="product[1][cost]" id="p_c_{{$key+1}}" value="{{$item->product_cost}}"/>
                                    </td>
                                    <td><input type="number" class="product_input" id="p_q_{{$key+1}}" name="product[{{$key+1}}][qty]"  value="{{$item->product_qty}}" onkeyup="return reCalculate({{$key+1}})" onmouseup="return reCalculate({{$key+1}})"  min="0"  autocomplete="off"/></td>
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
                                 <tr id="hidden-row-4" style="display: none">
                                    <td colspan="4" class="text-right"><strong> الضريبة[<span id="tax" style="color: goldenrod">0</span>%]</strong></td>
                                    <td  class="text-left"><code><span id="tax_amount">0</span></code>&nbsp;ج.م</td>
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
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab14" data-toggle="tab" aria-controls="tab14" href="#tab14" aria-expanded="false">الضريبة</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="base-tab15" data-toggle="tab" aria-controls="tab15" href="#tab15" aria-expanded="false">الفاتورة الورقية</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
                         <div class="row">
                              <div class="col-md-4"  id="dis_per">
                                  <div class="form-group">
                                      <label for="projectinput3">الخصم</label>
                                      <input type="number" id="curr_per" class="form-control" placeholder="" name="discount_percentage" value="{{$invoice->discount_percentage}}" min="0" max="100" onkeyup="return calculateDiscount(1)" onmouseup="return calculateDiscount(1)"  autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-md-4" style="display: none" id="dis_amount">
                                <div class="form-group">
                                    <label for="projectinput3">الخصم</label>
                                    <input type="number" id="curr_amount" class="form-control" placeholder="" name="discount_amount" value="{{$invoice->discount_amount}}" min="0" onkeyup="return calculateDiscount(2)" onmouseup="return calculateDiscount(2)" autocomplete="off">
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
                                      <input type="number" id="shipping_fees" class="form-control" placeholder="" name="shipping_fees" value="{{$invoice->shipping_fees}}" onkeyup="return updateShipping()" onmouseup="return updateShipping()" required autocomplete="off">
                                  </div>
                              </div>
                          </div>

                      </div>
                      <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput3">نسبة الضريبة</label>
                                    <input type="number" id="tax_fees" class="form-control" placeholder="" name="tax" value="{{$invoice->invoice_tax}}" onkeyup="return updateTax()" onmouseup="return updateTax()" required  autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab15" aria-labelledby="base-tab15">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput3">رقم الفاتورة الورقية</label>
                                    <input type="text" id="" class="form-control" placeholder="" name="invoice_paper_num" value="{{$invoice->invoice_paper_num}}"  autocomplete="off">
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
                            <div class="col-md-6">
                                <script type="text/javascript">
                                    function pay(url) {
                                        popupWindow = window.open(
                                        url,'popUpWindow','height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
                                    }

                                    </script>
                                @if($invoice->already_paid)
                                <h2 class="text-success"><span class="la la-check-circle"></span>تم الدفع</h2>
                                <br>
                                    @if($invoice->payment_method !='later')
                                <p><label>رقم إيصال الدفع: </label> {{$invoice->safe_transaction_id}}</p>
                                <p><label>الخزنة المدفوع بها: </label> {{$invoice->safe->safe_name}}</p>
                                    @endif
                                @else
                                <h2 class="text-danger"><span class="la la-exclamation-circle"></span>لم يتم الدفع</h2>
                                @endif
                            </div>
                            <input type="checkbox" name="already_paid" id="hasPaid" style="display: none" @if($invoice->already_paid) checked @endif>

                            <div class="col-md-6" id="notPaid" @if($invoice->already_paid) style="display: none" @else style="display: block" @endif>
                                <div class="form-group">
                                <select class="form-control" id="payment_method" name="payment_method">
                                    <option value="{{$invoice->payment_method}}">تعديل طريقة الدفع</option>
                                    <option value="cash">كاش</option>
                                    <option value="visa">فيزا</option>
                                    <option value="later">اجل (دفعات)</option>
                                    <option value="bankTransfer">تحويل بنكي</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6" @if($invoice->already_paid) style="display: block" @else style="display: none" @endif  id="yesPaid">
                                @if($invoice->payment_method !='later')
                                <div class="form-group">
                                    <button type="button" class="btn btn-dark" onclick="return pay('{{route('safes.receipt',$invoice->safe_transaction_id)}}');">استعراض إيصال الدفع</button>
                                <input type="hidden" class="form-control" name="safe_transaction_id" value="{{$invoice->safe_transaction_id}}"/>
                            </div>
                            @endif
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
                            <label for="projectinput3">اختر الخزنة التي سيتم الايداع بها</label>
                            <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id_not_paid">
                                <option></option>
                                @foreach ($invoice->allSafes() as $safe)
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
            @if($invoice->payment_method == 'later')
            <div class="col-md-12" id="later_box"   style="display: block"   >
                <div class="card">
                    <div class="card-body">
                        <span class="text-danger" style="display: none" id="dof3aError">إجمالي الدفعات لا تساوي إجمالي المبلغ</span>

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
                            @if ($invoice->datesInInvoice->isEmpty())
                            <tr>
                                <th scope="row">
                                    <div class="form-group">
                                        <input type="number" id="" class="form-control dof3aSum" placeholder="أدخل المبلغ" name="later[1][amount]" value="0"  autocomplete="off">
                                    </div>
                                </th>
                                <td>
                                    <fieldset class="form-group">
                                    <input type="date" class="form-control"    name="later[1][date]" required  autocomplete="off">
                                </fieldset>
                                <fieldset class="form-group">
                                    <div class="labrl">الملاحظات</div>
                                    <textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[1][notes]"></textarea>
                                </fieldset>
                            </td>

                                <td>
                                    <fieldset class="checkboxsas">
                                        <label>
                                            دفع الان
                                          <input type="checkbox" name="later[1][paynow]" onchange="return payNow(1)">
                                        </label>
                                    </fieldset>
                                    <div class="form-group" style="display:none;" id="pay_now_1">
                                        <label for="projectinput3">خصم من:</label>
                                        <select class="select2-rtl form-control" data-placeholder="الخزنة" name="later[1][safe_id]" id="sel_xx_1">
                                            <option></option>
                                            @foreach ($invoice->allSafes() as $safe)
                                            <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            @else
                            @foreach ($invoice->datesInInvoice as $key2 => $item)
                            <tr>
                                <th scope="row">
                                    <div class="form-group">
                                        <input type="number"   class="form-control dof3aSum" placeholder="أدخل المبلغ" name="later[{{$key2+1}}][amount]" value="{{$item->amount}}" @if($item->paid != 'No') readonly @endif  autocomplete="off">
                                    </div>
                                </th>
                                <td>
                                    <fieldset class="form-group">
                                    <input type="date" class="form-control"    name="later[{{$key2+1}}][date]"  value="{{$item->date}}" @if($item->paid != 'No') readonly @endif  autocomplete="off">
                                </fieldset>
                                <fieldset class="form-group">
                                    <div class="label">الملاحظات</div>
                                    <textarea class="form-control"  rows="3" placeholder="مثال: الدفعه المقدمة" name="later[{{$key2+1}}][notes]" @if($item->paid != 'No') readonly @endif>{{$item->notes}}</textarea>
                                </fieldset>
                            </td>

                                <td>
                                    @if($item->paid != 'No')
                                <p class="text-success"> <input type="checkbox" name="later[{{$key2+1}}][paynow]" checked onclick="return false;"/> تم الدفع</p>
                                <p><label>رقم فاتورة الدفع: </label> {{$item->safe_payment_id}}</p>
                                <button class="btn btn-dark" type="button" onclick="return pay('{{route('safes.receipt',$item->safe_payment_id)}}');">استعراض الفاتورة</button>
                                <input type="hidden" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[{{$key2+1}}][safe_payment_id]" value="{{$item->safe_payment_id}}">
                                <input type="hidden" name="later[{{$key2+1}}][safe_id]" value="{{$item->safe_id}}">
                                    @else
                                    <fieldset class="checkboxsas">
                                        <label>
                                            دفع الان
                                          <input type="checkbox" name="later[{{$key2+1}}][paynow]" onchange="return payNow({{$key2+1}})">
                                        </label>
                                    </fieldset>
                                    <div class="form-group" style="display:none;" id="pay_now_{{$key2+1}}">
                                        <label for="projectinput3">خصم من:</label>
                                        <select class="select2-rtl form-control" data-placeholder="الخزنة" name="later[{{$key2+1}}][safe_id]" id="sel_xx_{{$key2+1}}">
                                            <option></option>
                                            @foreach ($invoice->allSafes() as $safe)
                                            <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif




                                    {{-- <fieldset class="checkboxsas">
                                        <label>
                                            مدفوعه
                                          <input type="checkbox" name="later[{{$key2+1}}][paid]" @if($item->paid != 'No') checked  @endif onchange="return laterPaid({{$key2+1}})">
                                        </label>
                                    </fieldset> --}}


                                    {{-- <div id="later_dates_{{$key2+1}}" @if($item->paid != 'No') style="display: block" @else style="display:none;"  @endif>
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
                                            @foreach ($invoice->allSafes() as $safe)
                                            <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div> --}}

                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    </div>
                </div>



                    </div>
                </div>
            </div>
        @endif

        </div>
        </div>
  </div>






  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">
                    <button type="submit" class="btn btn-outline-primary btn-block" id="saveBtn"><i class="la la-check-square-o"></i> حفظ</button>

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
    <script>








$(document).on("keyup mouseup", ".dof3aSum", function() {
    var sum = 0;
    var total = $('#total_after_all2').text();
    total = parseInt(total);
    $(".dof3aSum").each(function(){
        sum += +$(this).val();
    });
    console.log('function works');
    if(total != sum){
        $('#dof3aError').css('display','block');
        $('#saveBtn').attr('disabled',true);
    }else{
        $('#dof3aError').css('display','none');
        $('#saveBtn').attr('disabled',false);


    }
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

  var currentInvoiceTotal = $("#total_after_all").text();
  currentInvoiceTotal = parseInt(currentInvoiceTotal);
  var newInvoiceTotal = currentInvoiceTotal - (currentInvoiceTotal * (newTax / 100));
  var taxAmount = currentInvoiceTotal - newInvoiceTotal;
  taxAmount = Math.round(taxAmount);
  $('#tax_amount').text(taxAmount);

$('#tax').html(newTax);
updateTotal();
}

CKEDITOR.ClassicEditor.create( document.querySelector( '#terms-conditions' ) ).catch( error => {console.error( error );} );

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
                // $("#addingRowBtn").prop("disabled",false);
            },
            error: function (data) {
                console.log(data);
            }
        });


        var ajaxurl = "{{route('products.fetchCost')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#p_c_"+row).val(data.cost);
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
  alert(theValue);
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
  alert(theValue);
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

//currentProductIds.pop(1);
}


$('#payment_method').on('change', function() {
if (this.value == 'later') {
  //$('#init_box').hide();
  $('#other_box').hide();
  $('#later_box').show();
  $('#hasPaid').prop( "checked", false );

} else if (this.value == 'cash' || this.value == 'visa' || this.value == 'bankTransfer') {
  //$('#init_box').hide();
  $('#later_box').hide();
  $('#other_box').show();
  $('#hasPaid').prop( "checked", true );
} else {
  $('#later_box').hide();
  $('#other_box').hide();
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
currentCell.innerHTML = '<div class="form-group"><input type="number" id="" class="form-control dof3aSum" placeholder="أدخل المبلغ" name="later['+currentIndex+'][amount]" value="0" required  autocomplete="off"></div>';

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<fieldset class="form-group"><input type="date" class="form-control" name="later['+currentIndex+'][date]" required  autocomplete="off"></fieldset><fieldset class="form-group"><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later['+currentIndex+'][notes]"></textarea></fieldset>';

var currentCell = currentRow.insertCell(-1);
//currentCell.innerHTML = '<fieldset class="checkboxsas"><label><input type="checkbox" name="later['+currentIndex+'][paid]">مدفوعه</label></fieldset>';
//currentCell.innerHTML = '<fieldset class="checkboxsas"><label>مدفوعه<input type="checkbox" name="later['+currentIndex+'][paid]" onchange="return laterPaid('+currentIndex+')"></label></fieldset><div id="later_dates_'+currentIndex+'" style="display:none;"><div class="form-group"><div class="label">رقم العملية في الخزنة:</div><input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later['+currentIndex+'][safe_payment_id]"></div><div class="form-group"><label for="projectinput3">خصمت من:</label><select class="select2-rtl form-control" data-placeholder="تعديل" name="later['+currentIndex+'][safe_id]"><option></option> @foreach ($invoice->allSafes() as $safe) <option value="{{$safe->id}}">{{$safe->safe_name}}</option> @endforeach </select></div></div>';
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
var currentRow = myTable.insertRow(myTable.rows.length - 6);

// var product_id = document.createElement("input");
// // product_id.setAttribute("name", "product_id[" + currentIndex + "]");
// product_id.setAttribute("name", "product[" + currentIndex + "][id]");
// product_id.setAttribute("class", "product_input");

var product_desc = document.createElement("input");
product_desc.setAttribute("name", "product[" + currentIndex + "][desc]");
product_desc.setAttribute("class", "product_input");
product_desc.setAttribute("autocomplete", "off");

var product_price = document.createElement("input");
product_price.setAttribute("name", "product[" + currentIndex + "][price]");
product_price.setAttribute("type", "number");
product_price.setAttribute("min", "0");
product_price.setAttribute("class", "product_input");
product_price.setAttribute("id", "p_p_" + currentIndex);
product_price.setAttribute("onkeyup", "return reCalculate(" + currentIndex + ")");
product_price.setAttribute("onmouseup", "return reCalculate(" + currentIndex + ")");
product_price.setAttribute("autocomplete", "off");

var product_cost = document.createElement("input");
product_cost.setAttribute("name","product[" + currentIndex + "][cost]");
product_cost.setAttribute("type","hidden");
product_cost.setAttribute("id","p_c_" + currentIndex);

var product_qty = document.createElement("input");
product_qty.setAttribute("name", "product[" + currentIndex + "][qty]");
product_qty.setAttribute("type", "number");
product_qty.setAttribute("min", "0");
product_qty.setAttribute("class", "product_input");
product_qty.setAttribute("id", "p_q_" + currentIndex);
product_qty.setAttribute("onkeyup", "return reCalculate(" + currentIndex + ")");
product_qty.setAttribute("onmouseup", "return reCalculate(" + currentIndex + ")");
product_qty.setAttribute("placeholder", "0");
product_qty.setAttribute("autocomplete", "off");

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required onchange="return getProductInfo(this,'+currentIndex+')"><option></option> @foreach ($invoice->allProducts() as $product) <option value="{{$product->id}}">{{$product->product_name}}</option>  @endforeach</select></div>';

//currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required onchange="return getProductInfo(this,'+currentIndex+')"> </select></div>';


$('#sel_x_' + currentIndex).select2();

currentCell = currentRow.insertCell(-1);
currentCell.appendChild(product_desc);

currentCell = currentRow.insertCell(-1);
currentCell.appendChild(product_price);
currentCell.appendChild(product_cost);

currentCell = currentRow.insertCell(-1);
currentCell.appendChild(product_qty);

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = ' <span id="tot_' + currentIndex + '">0</span> ج.م';

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<center><button type="button" class="btn btn-danger btn-sm" onclick="return delRow(' + currentIndex + ')" style="vertical-align:center">X</button></center>';
}

        </script>

 @endsection

