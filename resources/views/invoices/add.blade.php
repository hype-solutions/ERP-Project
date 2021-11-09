@extends('layouts.erp')
@section('title', 'فاتورة جديدة')

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

                <form method="POST" action="{{ route('invoices.adding') }}">
                    @csrf


                    <input type="hidden" name="sold_by" value="{{ $invoice->loggedInUserId() }}" />
                    <input type="hidden" name="invoice_total" id="totalToSave" value="0" />

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-flag"></i> فاتورة جديدة</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="text-bold-600 font-medium-2">
                                                            اختر الفرع
                                                        </div>
                                                        <select class="select2-rtl form-control"
                                                            data-placeholder="إختر الفرع..." name="branch_id" id="branch_id"
                                                            required>
                                                            <option></option>
                                                            @foreach ($invoice->allBranches() as $branch)
                                                                <option value="{{ $branch->id }}">
                                                                    {{ $branch->branch_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-bold-600 font-medium-2">
                                                            رقم الفاتورة الورقية
                                                        </div>
                                                        <input type="text" class="form-control" name="invoice_paper_num"
                                                            placeholder="أدخل الرقم" autocomplete="off" />
                                                    </div>
                                                </div>

                                                <div class="col-md-4" style="border-left: 6px solid #28d094;
                                    height: 170px;">
                                                    <div class="form-group">
                                                        <div class="text-bold-600 font-medium-2">
                                                            عميل حالي
                                                        </div>
                                                        <select class="select2-rtl form-control"
                                                            data-placeholder="إختر العميل..." name="customer_id"
                                                            id="customer_id" required>
                                                            <option></option>
                                                            @foreach ($invoice->allCustomers() as $customer)
                                                                <option value="{{ $customer->id }}">
                                                                    {{ $customer->customer_name }}
                                                                    @if ($customer->parent)
                                                                        - {{ $customer->parent->customer_name }}
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>أو</label>
                                                        <div class="text-bold-600 font-medium-2">
                                                            عميل جديد
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="new_customer_name" id="new_customer_name"
                                                                placeholder="اسم العميل"
                                                                onblur="return chooseCustomerType()" autocomplete="off" />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                name="new_customer_mobile" id="new_customer_mobile"
                                                                placeholder="موبايل العميل"
                                                                onblur="return chooseCustomerType()" autocomplete="off" />
                                                            <small id="customerHelp" class="text-danger"
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

                                        <fieldset class="form-group">
                                            <p class="text-muted">الشروط / الملاحظات</p>
                                            <textarea class="form-control" name="invoice_note" rows="8"
                                                id="terms-conditions"></textarea>
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
                                                                    required onchange="return getProductInfo(this,1)">
                                                                    <option></option>
                                                                    @foreach ($invoice->allProducts() as $product)
                                                                        <option value="{{ $product->id }}">
                                                                            {{ $product->product_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="product_input"
                                                                name="product[1][desc]" autocomplete="off" /></td>
                                                        <td><input type="number" class="product_input" id="p_p_1"
                                                                name="product[1][price]" onblur="return reCalculate(1)"
                                                                min="0" required @can('Change Product Price in Invoice')
                                                            @else readonly @endcan autocomplete="off" />
                                                        <input type="hidden" name="product[1][cost]" id="p_c_1" />
                                                    </td>
                                                    <td><input type="number" class="product_input" id="p_q_1"
                                                            name="product[1][qty]" onblur="return reCalculate(1)"
                                                            min="0" placeholder="0" required autocomplete="off" /></td>
                                                    <td>
                                                        <span id="tot_1">0</span> ج.م
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2" style="border-style: none !important;">
                                                        <div>
                                                            <button type="button" onclick="addField()"
                                                                class="add-row btn m-b-xs btn-sm btn-success btn-addon btn-blue"
                                                                id="addingRowBtn">
                                                                <i class="la la-plus"></i>
                                                                إضافة بند
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td colspan="2" class="text-right"
                                                        style="border-style: none !important;"><strong>الإجمالي</strong>
                                                    </td>
                                                    <td class="text-left" style="border-style: none !important;">
                                                        <code><span id="total_after_all">0</span></code>&nbsp;ج.م</td>
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
                                                    <td colspan="4" class="text-right"><strong>الخصم
                                                            (المبلغ)</strong></td>
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
                                                    <td colspan="4" class="text-right"><strong> الضريبة[<span
                                                                id="tax" style="color: goldenrod">0</span>%]</strong>
                                                    </td>
                                                    <td class="text-left"><code><span
                                                                id="tax_amount">0</span></code>&nbsp;ج.م</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-right"><strong>الإجمالي</strong>
                                                    </td>
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
                                            <a class="nav-link" id="base-tab13" data-toggle="tab"
                                                aria-controls="tab13" href="#tab13" aria-expanded="false">الشحن</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab14" data-toggle="tab"
                                                aria-controls="tab14" href="#tab14" aria-expanded="false">الضريبة</a>
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
                                                            max="100" onblur="return calculateDiscount(1)"
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display: none" id="dis_amount">
                                                    <div class="form-group">
                                                        <label for="projectinput3">الخصم</label>
                                                        <input type="number" id="curr_amount" class="form-control"
                                                            placeholder="" name="discount_amount" value="0" min="0"
                                                            onblur="return calculateDiscount(2)" autocomplete="off">
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
                                                            onblur="return updateShipping()" required
                                                            autocomplete="off">
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
                                                            onblur="return updateTax()" required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                    <fieldset class="checkboxsas">
                        <label>
                          <input type="checkbox" name="already_delivered" id="hasDelivered" >
                         هل تم الإستلام بالفعل؟
                                      </label>
                    </fieldset>
                    <div class="div" id="delivery_info" style="display: none">
                        <fieldset class="form-group">
                            <div class="label">تاريخ الإستلام</div>
                            <input type="date" class="form-control" id="date"  name="delivery_date">
                        </fieldset>
                        <div class="form-group">
                            <label> اختر الفرع (المخزن) المستلم:</label>


                            <select class="select2-rtl form-control" data-placeholder="إختر الفرع..." name="branch_id">

                                <option></option>

                            </select>
                          </div>
                    </div>
                </div>
            </div>
        </div> --}}
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6" style="display: none">
                                                <fieldset class="checkboxsas">
                                                    <label>
                                                        <input type="checkbox" name="already_paid" id="hasPaid">
                                                        هل تم الدفع بالفعل؟
                                                    </label>
                                                </fieldset>

                                            </div>
                                            <div class="col-md-12" id="notPaid">
                                                <div class="form-group">
                                                    <select class="form-control" id="payment_method"
                                                        name="payment_method" required>
                                                        <option value="none">إختر طريقة الدفع</option>
                                                        <option value="cash">كاش</option>
                                                        <option value="visa">فيزا</option>
                                                        <option value="later">اجل (دفعات)</option>
                                                        <option value="bankTransfer">تحويل بنكي</option>
                                                    </select>
                                                </div>
                                            </div>
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

                        </select>
                    </div>
                    </div> --}}
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
                                                        <label for="projectinput3">إختر الخزنة التي سيتم التوريد
                                                            بها</label>
                                                        <select class="select2-rtl form-control"
                                                            data-placeholder="إختر الخزنة..." name="safe_id_not_paid">
                                                            <option></option>
                                                            @foreach ($invoice->allSafes() as $safe)
                                                                <option value="{{ $safe->id }}">
                                                                    {{ $safe->safe_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3">الملاحظات</label>
                                                        <textarea placeholder="مثال: رقم الحوالة"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>




                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" id="later_box" style="display: none">
                                <div class="card">
                                    <div class="card-body">
                                        <span class="text-danger" style="display: none" id="dof3aError">إجمالي
                                            الدفعات لا تساوي إجمالي المبلغ</span>
                                        <div>
                                            <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button
                                                    onclick="addDofaa()" type="button"
                                                    class="btn btn-success btn-sm"><i
                                                        class="la la-plus"></i></button></h4>
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
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="form-group">
                                                                    <input type="number" id=""
                                                                        class="form-control dof3aSum"
                                                                        placeholder="أدخل المبلغ"
                                                                        name="later[1][amount]" value="0"
                                                                        autocomplete="off">
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <fieldset class="form-group">
                                                                    <input type="date" class="form-control"
                                                                        name="later[1][date]" value="2021-01-10"
                                                                        required autocomplete="off">
                                                                </fieldset>
                                                                <fieldset class="form-group">
                                                                    <div class="labrl">الملاحظات</div>
                                                                    <textarea class="form-control" id="placeTextarea"
                                                                        rows="3" placeholder="مثال: الدفعه المقدمة"
                                                                        name="later[1][notes]"></textarea>
                                                                </fieldset>
                                                            </td>

                                                            <td>
                                                                <fieldset class="checkboxsas">
                                                                    <label>
                                                                        دفع الان
                                                                        <input type="checkbox" name="later[1][paynow]">
                                                                    </label>
                                                                </fieldset>


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
                </div>






                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
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


@can('Change Product Price in Invoice')
    <span style="display: none">{{ $readonly = 'false' }}</span>
@else
    <span style="display: none">{{ $readonly = 'true' }}</span>
@endcan


@include('common.footer')
@endsection

@section('pageJs')

<script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js') }}"></script>



<script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
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

    function chooseCustomerType() {
        newCustomerName = $('#new_customer_name').val().length;
        newCustomerMobile = $('#new_customer_mobile').val().length;
        OldCustomerSelect = $('#customer_id').val().length;
        if (newCustomerName > 0) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                customer_mobile: $('#new_customer_mobile').val(),
            };
            var type = "POST";
            var ajaxurl = "{{ route('customers.checkcustomer') }}";
            $.ajax({
                type: type,
                url: ajaxurl,
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.data > 0) {
                        $('#customerHelp').css('display', 'block');
                        $('#new_customer_mobile').addClass('is-invalid');
                        $('#new_customer_mobile').removeClass('is-valid');
                        $("#saveBtn").prop("disabled", true);
                    } else {
                        $('#customerHelp').css('display', 'none');
                        $('#new_customer_mobile').addClass('is-valid');
                        $('#new_customer_mobile').removeClass('is-invalid');
                        $("#saveBtn").prop("disabled", false);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });



            $("#customer_id").attr({
                "required": false
            });
            $("#new_customer_name").attr({
                "required": true
            });
            $("#new_customer_mobile").attr({
                "required": true
            });
        } else {
            $("#customer_id").attr({
                "required": true
            });
            $("#new_customer_name").attr({
                "required": false
            });
            $("#new_customer_mobile").attr({
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

    CKEDITOR.ClassicEditor.create(document.querySelector('#terms-conditions')).catch(error => {
        console.error(error);
    });

    $(document).ready(function() {

        currentProductIds = [];
        $('#hasPaid').change(function() {

            if ($('#hasPaid').prop('checked')) {
                $('#notPaid').hide();
                $('#yesPaid').show();
                $('#yesPaid2').show();
                $('#other_box').hide();
                $('#later_box').hide();

            } else {
                $('#yesPaid').hide();
                $('#yesPaid2').hide();
                $('#notPaid').show();

            }
        });
    });

    function getProductInfo(product, row) {

        var branch_id = 1;

        var get_branch_id = $('#branch_id').val();

        if (get_branch_id > 0) {
            branch_id = get_branch_id;
        } else {
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
        var ajaxurl = "{{ route('products.fetchQty') }}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $("#addingRowBtn").prop("disabled", true);
            },
            success: function(data) {

                // $("#p_q_1").val(data.amount);
                $("#p_q_" + row).attr({
                    "max": data.amount
                });
                $("#p_q_" + row).attr({
                    "placeholder": "متاح: " + data.amount
                });
            },
            error: function(data) {
                console.log(data);
            }
        });

        var ajaxurl = "{{ route('products.fetchPrice') }}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function(data) {
                $("#p_p_" + row).val(data.price);
                reCalculate(row);
                // $("#addingRowBtn").prop("disabled",false);
            },
            error: function(data) {
                console.log(data);
            }
        });


        var ajaxurl = "{{ route('products.fetchCost') }}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function(data) {
                $("#p_c_" + row).val(data.cost);
                reCalculate(row);
                $("#addingRowBtn").prop("disabled", false);
            },
            error: function(data) {
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

        //currentProductIds.pop(1);
    }


    $('#payment_method').on('change', function() {
        if (this.value == 'later') {
            //$('#init_box').hide();
            $('#other_box').hide();
            $('#later_box').show();
            $('#hasPaid').prop("checked", false);
            $('#saveBtn').attr('disabled', true);

        } else if (this.value == 'cash' || this.value == 'visa' || this.value == 'bankTransfer') {
            //$('#init_box').hide();
            $('#later_box').hide();
            $('#other_box').show();
            $('#hasPaid').prop("checked", true);
            $('#saveBtn').attr('disabled', false);
        } else {
            $('#later_box').hide();
            $('#other_box').hide();
            $('#init_box').show();
            $('#hasPaid').prop("checked", false);
            $('#saveBtn').attr('disabled', false);
        }
    });


    function addDofaa() {

        var dofaaTable = document.getElementById("dofaaTable");
        var currentIndex = dofaaTable.rows.length;
        var currentRow = dofaaTable.insertRow(-1);


        var currentCell = currentRow.insertCell(-1);
        currentCell.innerHTML =
            '<div class="form-group"><input type="number" id="" class="form-control dof3aSum" placeholder="أدخل المبلغ" name="later[' +
            currentIndex + '][amount]" value="0" required  autocomplete="off"></div>';

        var currentCell = currentRow.insertCell(-1);
        currentCell.innerHTML = '<fieldset class="form-group"><input type="date" class="form-control"  name="later[' +
            currentIndex +
            '][date]" required  autocomplete="off"></fieldset><fieldset class="form-group"><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[' +
            currentIndex + '][notes]"></textarea></fieldset>';

        var currentCell = currentRow.insertCell(-1);
        //currentCell.innerHTML = '<fieldset class="checkboxsas"><label><input type="checkbox" name="later['+currentIndex+'][paid]">مدفوعه</label></fieldset>';
        //currentCell.innerHTML = '<fieldset class="checkboxsas"><label>مدفوعه<input type="checkbox" name="later['+currentIndex+'][paid]" onchange="return laterPaid('+currentIndex+')"></label></fieldset><div id="later_dates_'+currentIndex+'" style="display:none;"><div class="form-group"><div class="label">رقم العملية في الخزنة:</div><input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later['+currentIndex+'][safe_payment_id]"></div><div class="form-group"><label for="projectinput3">خصمت من:</label><select class="select2-rtl form-control" data-placeholder="تعديل" name="later['+currentIndex+'][safe_id]"><option></option><option  </select></div></div>';
        currentCell.innerHTML = '<fieldset class="checkboxsas"><label>دفع الان <input type="checkbox" name="later[' +
            currentIndex + '][paynow]"></label></fieldset>'

    }




    function addField(argument) {
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
        product_price.setAttribute("required", true);
        product_price.setAttribute("class", "product_input");
        product_price.setAttribute("id", "p_p_" + currentIndex);
        product_price.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
        product_price.setAttribute("autocomplete", "off");
        if ({{ $readonly }}) {
            product_price.setAttribute("readonly", true);
        } else {
            product_price.removeAttribute("readonly");
        }



        var product_cost = document.createElement("input");
        product_cost.setAttribute("name", "product[" + currentIndex + "][cost]");
        product_cost.setAttribute("type", "hidden");
        product_cost.setAttribute("id", "p_c_" + currentIndex);

        var product_qty = document.createElement("input");
        product_qty.setAttribute("name", "product[" + currentIndex + "][qty]");
        product_qty.setAttribute("type", "number");
        product_qty.setAttribute("min", "0");
        product_qty.setAttribute("required", true);
        product_qty.setAttribute("class", "product_input");
        product_qty.setAttribute("id", "p_q_" + currentIndex);
        product_qty.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
        product_qty.setAttribute("placeholder", "0");
        product_qty.setAttribute("autocomplete", "off");

        var currentCell = currentRow.insertCell(-1);
        currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex +
            '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[' + currentIndex +
            '][id]" required onchange="return getProductInfo(this,' + currentIndex +
            ')"><option></option> @foreach ($invoice->allProducts() as $product) <option value="{{ $product->id }}">{{ $product->product_name }}</option>  @endforeach</select></div>';

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
        currentCell.innerHTML = '<center><button type="button" class="btn btn-danger btn-sm" onclick="return delRow(' +
            currentIndex + ')" style="vertical-align:center">X</button></center>';
    }
</script>

@endsection
