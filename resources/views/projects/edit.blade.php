@extends('layouts.erp')

@section('pageCss')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/wizard.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/plugins/pickers/daterange/daterange.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <style>
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
    <script type="text/javascript">
        function pay(url) {
            popupWindow = window.open(
                url, 'popUpWindow',
                'height=700,width=300,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no'
                )
        }

    </script>
    <!-- END: Page CSS-->
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
                    @if (session()->get('success') == 'project Added')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> إضافة عميل جديد
                        </div>
                    @endif
                @endif
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('projects.list') }}">المشروعات</a></li>
                                    <li class="breadcrumb-item active">إضافة مشروع جديد
                                    </li>
                                </ol>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                <section id="icon-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form action="{{ route('projects.update', $project) }}" method="POST"
                                            class="icons-tab-steps wizard-notification" id="mashroo3"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="created_by" value="{{ $user_id }}" />
                                            <input type="hidden" name="total" id="totalToSave" value="0" />
                                            <input type="hidden" name="step" id="theStep" value="{{ $project->step }}" />
                                            <input type="hidden" name="returnHere" id="returnHere" value="0" />
                                            <!-- Step 1 -->
                                            <h6><i class="step-icon la la-eye"></i> بيانات المشروع</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstName2">اسم المشروع:</label>
                                                            <input type="text" class="form-control" id="firstName2"
                                                                name="project_name" value="{{ $project->project_name }}"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-bold-600 font-medium-2">
                                                                المستفيد:
                                                            </div>
                                                            <select class="select2-rtl form-control"
                                                                data-placeholder="إختر العميل..." name="customer_id"
                                                                required>
                                                                <option value="{{ $project->customer_id }}">
                                                                    {{ $project->customer->customer_name }}</option>
                                                                @foreach ($customers as $customer)
                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->customer_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date2">تاريخ بداية المشروع:</label>
                                                            <input type="date" class="form-control" id="date2"
                                                                name="project_start_date"
                                                                value="{{ $project->project_start_date }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date2">موعد استحقاق المشروع:</label>
                                                            <input type="date" class="form-control" id="date2"
                                                                name="project_end_date"
                                                                value="{{ $project->project_end_date }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <button type="button" onclick="stepsWizard.steps('next')"
                                                        class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                        style="float: left">التالي</a>
                                                        <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                            style="float: left">حفظ</button>
                                                </div>
                                            </fieldset>

                                            <!-- Step 1 -->
                                            <h6><i class="step-icon la la-eye"></i> المعاينة</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label>أرفق ملفات المعاينة</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="mo3ayna[]"
                                                                    class="custom-file-input" id="inputGroupFile02"
                                                                    multiple>
                                                                <label class="custom-file-label" for="inputGroupFile02"
                                                                    aria-describedby="inputGroupFile02">اختر الملف </label>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-6">
                                                        @if ($previewFiles->count() > 0)
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>اسم الملف</th>
                                                                            <th>نوع الملف</th>
                                                                            <th>التحكم</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($previewFiles as $key2 => $item)
                                                                            <tr>
                                                                                <th scope="row">{{ ++$key2 }}</th>
                                                                                <td>{{ $item->file_name }}</td>
                                                                                <td>{{ $item->file_ext }}</td>
                                                                                <td>
                                                                                    <a target="_blank"
                                                                                        href="/uploads/{{ $item->file_path }}"
                                                                                        class="btn btn-success btn-sm">استعراض</a>
                                                                                    <button
                                                                                        class="btn btn-danger btn-sm">حذف</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <p class="text-center text-danger mt-3">لا توجد ملفات مرفوعه</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="mo3ayna_details" class="form-control" id=""
                                                                cols="5" rows="10"
                                                                placeholder="تفاصيل المعاينة">{{ $project->mo3ayna_details }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    @if ($project->step == 1)
                                                        <button type="button" onclick="return updateProj(1)"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">الإنتقال الى عرض السعر</button>
                                                    @else
                                                        <button type="button" onclick="stepsWizard.steps('next')"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">التالي</a>
                                                    @endif
                                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                        style="float: left">حفظ و عودة لاحقا</button>
                                                </div>
                                            </fieldset>

                                            <!-- Step 2 -->
                                            <h6><i class="step-icon la la-th-list"></i>عرض السعر</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-content collapse show">
                                                                <div class="card-body">

                                                                    <div class="form-group">
                                                                        <!-- Outline Buttons Glow -->
                                                                        <button type="button"
                                                                            class="btn btn-outline-info btn-min-width btn-glow mr-1 mb-1">طباعة</button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-warning btn-min-width btn-glow mr-1 mb-1">ارسال
                                                                            بالبريد</button>
                                                                    </div>

                                                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" id="base-tab11"
                                                                                data-toggle="tab" aria-controls="tab11"
                                                                                href="#tab11" aria-expanded="true">الخصم</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="base-tab13"
                                                                                data-toggle="tab" aria-controls="tab13"
                                                                                href="#tab13"
                                                                                aria-expanded="false">الشحن</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="base-tab14"
                                                                                data-toggle="tab" aria-controls="tab14"
                                                                                href="#tab14"
                                                                                aria-expanded="false">الضريبة</a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="tab-content px-1 pt-1">
                                                                        <div role="tabpanel" class="tab-pane active"
                                                                            id="tab11" aria-expanded="true"
                                                                            aria-labelledby="base-tab11">
                                                                            <div class="row">
                                                                                <div class="col-md-4" id="dis_per">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="projectinput3">الخصم</label>
                                                                                        <input type="number" id="curr_per"
                                                                                            class="form-control"
                                                                                            placeholder=""
                                                                                            name="discount_percentage"
                                                                                            value="{{ $project->discount_percentage }}"
                                                                                            min="0" max="100"
                                                                                            onblur="return calculateDiscount(1)">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4" style="display: none"
                                                                                    id="dis_amount">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="projectinput3">الخصم</label>
                                                                                        <input type="number"
                                                                                            id="curr_amount"
                                                                                            class="form-control"
                                                                                            placeholder=""
                                                                                            name="discount_amount"
                                                                                            value="{{ $project->discount_amount }}"
                                                                                            min="0"
                                                                                            onblur="return calculateDiscount(2)">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="projectinput3">النوع</label>

                                                                                        <select class="form-control"
                                                                                            onchange="return changeDisType(this)">
                                                                                            <option value="percent">نسبة
                                                                                                مئوية (%)</option>
                                                                                            <option value="fixed">المبلغ
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="tab13"
                                                                            aria-labelledby="base-tab13">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="projectinput3">مصاريف
                                                                                            الشحن</label>
                                                                                        <input type="number"
                                                                                            id="shipping_fees"
                                                                                            class="form-control"
                                                                                            placeholder=""
                                                                                            name="shipping_fees"
                                                                                            value="{{ $project->shipping_fees }}"
                                                                                            onblur="return updateShipping()"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="tab-pane" id="tab14"
                                                                            aria-labelledby="base-tab14">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="projectinput3">نسبة
                                                                                            الضريبة</label>
                                                                                        <input type="number" id="tax_fees"
                                                                                            class="form-control"
                                                                                            placeholder="" name="tax"
                                                                                            value="{{ $project->tax }}"
                                                                                            onblur="return updateTax()"
                                                                                            required>
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
                                                        <div class="table-responsive">
                                                            <table class="table mb-0 table-bordered" id="myTable"
                                                                style="overflow: hidden;">
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
                                                                    @foreach ($priceQuotation as $key => $item)
                                                                        <tr id="row_{{ $key + 1 }}">
                                                                            <td>
                                                                                <div class="form-group product_sel">
                                                                                    <select class="select2-rtl form-control"
                                                                                        data-placeholder="إختر المنتج"
                                                                                        name="product[{{ $key + 1 }}][id]"
                                                                                        id="sel_x_{{ $key + 1 }}"
                                                                                        required
                                                                                        onchange="return getProductInfo(this,1)">
                                                                                        @if ($item->product_id > 0)
                                                                                            <option
                                                                                                value="{{ $item->product_id }}">
                                                                                                {{ $item->product->product_name }}
                                                                                            </option>
                                                                                        @else
                                                                                            <option
                                                                                                value="{{ $item->product_temp }}">
                                                                                                {{ $item->product_temp }}
                                                                                            </option>
                                                                                        @endif

                                                                                        @foreach ($products as $product)
                                                                                            <option
                                                                                                value="{{ $product->id }}">
                                                                                                {{ $product->product_name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td><input type="text" class="product_input"
                                                                                    name="product[{{ $key + 1 }}][desc]"
                                                                                    value="{{ $item->product_desc }}" />
                                                                            </td>
                                                                            <td><input type="number" class="product_input"
                                                                                    id="p_p_{{ $key + 1 }}"
                                                                                    name="product[{{ $key + 1 }}][price]"
                                                                                    value="{{ $item->product_price }}"
                                                                                    onblur="return reCalculate({{ $key + 1 }})"
                                                                                    min="0" /></td>
                                                                            <td><input type="number" class="product_input"
                                                                                    id="p_q_{{ $key + 1 }}"
                                                                                    name="product[{{ $key + 1 }}][qty]"
                                                                                    value="{{ $item->product_qty }}"
                                                                                    onblur="return reCalculate({{ $key + 1 }})"
                                                                                    min="0" placeholder="0" /></td>
                                                                            <td>
                                                                                <span id="tot_{{ $key + 1 }}">0</span>
                                                                                ج.م
                                                                            </td>
                                                                            <td></td>
                                                                        </tr>

                                                                    @endforeach
                                                                    <tr>
                                                                        <td colspan="2"
                                                                            style="border-style: none !important;">
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
                                                                            style="border-style: none !important;">
                                                                            <strong>الإجمالي</strong>
                                                                        </td>
                                                                        <td class="text-left"
                                                                            style="border-style: none !important;">
                                                                            <code><span
                                                                                    id="total_after_all">0</span></code>&nbsp;ج.م
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr id="hidden-row-1" style="display: none">
                                                                        <td colspan="4" class="text-right"><strong> الخصم
                                                                                (النسبة)[<span id="discount_percentage"
                                                                                    style="color: goldenrod">0</span>%]</strong>
                                                                        </td>
                                                                        <td id="TotalValue" class="text-left"><code><span
                                                                                    id="discount_percentage_amount">0</span></code>&nbsp;ج.م
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr id="hidden-row-2" style="display: none">
                                                                        <td colspan="4" class="text-right"><strong>الخصم
                                                                                (المبلغ)</strong></td>
                                                                        <td id="TotalValue" class="text-left"><code><span
                                                                                    id="discount_amount">0</span></code>&nbsp;ج.م
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr id="hidden-row-3" style="display: none">
                                                                        <td colspan="4" class="text-right">
                                                                            <strong>الشحن</strong>
                                                                        </td>
                                                                        <td id="TotalValue" class="text-left"><code><span
                                                                                    id="shipping">0</span></code>&nbsp;ج.م
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr id="hidden-row-4" style="display: none">
                                                                        <td colspan="4" class="text-right"><strong>
                                                                                الضريبة[<span id="tax"
                                                                                    style="color: goldenrod">0</span>%]</strong>
                                                                        </td>
                                                                        <td class="text-left"><code><span
                                                                                    id="tax_amount">0</span></code>&nbsp;ج.م
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4" class="text-right">
                                                                            <strong>الإجمالي</strong>
                                                                        </td>
                                                                        <td id="TotalValue" class="text-left"><code><span
                                                                                    id="total_after_all2">0</span></code>&nbsp;ج.م
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group mt-3">
                                                    @if ($project->step == 2)
                                                        <button type="button" onclick="return updateProj(2)"
                                                            class="btn mb-1 btn-danger btn-lg btn-glow"
                                                            style="float: left">رفض</button>
                                                        <button type="button" onclick="return updateProj(2)"
                                                            class="btn mb-1 btn-success btn-lg btn-glow"
                                                            style="float: left">تصديق على عرض السعر</button>
                                                    @else
                                                        <button type="button" onclick="stepsWizard.steps('next')"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">التالي</a>
                                                    @endif

                                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                        style="float: left">حفظ</button>
                                                </div>
                                            </fieldset>

                                            <!-- Step 3 -->
                                            <h6><i class="step-icon la la-list-alt"></i>بنود العقد</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label>أرفق بنود العقد</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="bnood[]" class="custom-file-input"
                                                                    id="inputGroupFile02" multiple>
                                                                <label class="custom-file-label" for="inputGroupFile02"
                                                                    aria-describedby="inputGroupFile02">اختر الملف </label>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-6">
                                                        @if ($contractFiles->count() > 0)
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>اسم الملف</th>
                                                                            <th>نوع الملف</th>
                                                                            <th>التحكم</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($contractFiles as $key3 => $item)
                                                                            <tr>
                                                                                <th scope="row">{{ ++$key3 }}</th>
                                                                                <td>{{ $item->file_name }}</td>
                                                                                <td>{{ $item->file_ext }}</td>
                                                                                <td>
                                                                                    <a target="_blank"
                                                                                        href="/uploads/{{ $item->file_path }}"
                                                                                        class="btn btn-success btn-sm">استعراض</a>
                                                                                    <button
                                                                                        class="btn btn-danger btn-sm">حذف</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <p class="text-center text-danger mt-3">لا توجد ملفات مرفوعه</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    @if ($project->step == 3)
                                                        <button type="button" onclick="return updateProj(3)"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">الإنتقال للدفعات</button>
                                                    @else
                                                        <button type="button" onclick="stepsWizard.steps('next')"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">التالي</a>
                                                    @endif
                                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                        style="float: left">حفظ و عودة لاحقا</button>
                                                </div>

                                            </fieldset>

                                            <!-- Step 4 -->
                                            <h6><i class="step-icon la la-money"></i>الدفعات</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <h4 class="form-section"><i class="la la-flag"></i> الدفعات
                                                                <button onclick="addDofaa()" type="button"
                                                                    class="btn btn-success btn-sm"><i
                                                                        class="la la-plus"></i></button>
                                                            </h4>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered   table-hover"
                                                                    id="dofaaTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>المبلغ</th>
                                                                            <th>تاريخ الإستحقاق</th>
                                                                            <th>تم دفعها؟</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if ($project->datesInProject->isEmpty())
                                                                            <tr>
                                                                                <th scope="row">
                                                                                    <div class="form-group">
                                                                                        <input type="number" id=""
                                                                                            class="form-control dof3aSum"
                                                                                            placeholder="أدخل المبلغ"
                                                                                            name="later[1][amount]"
                                                                                            value="0">
                                                                                    </div>
                                                                                </th>
                                                                                <td>
                                                                                    <fieldset class="form-group">
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            name="later[1][date]">
                                                                                    </fieldset>
                                                                                    <fieldset class="form-group">
                                                                                        <div class="labrl">الملاحظات</div>
                                                                                        <textarea class="form-control"
                                                                                            id="placeTextarea" rows="3"
                                                                                            placeholder="مثال: الدفعه المقدمة"
                                                                                            name="later[1][notes]"></textarea>
                                                                                    </fieldset>
                                                                                </td>

                                                                                <td>
                                                                                    <fieldset class="checkboxsas">
                                                                                        <label>
                                                                                            دفع الان
                                                                                            <input type="checkbox"
                                                                                                name="later[1][paynow]"
                                                                                                onchange="return payNow(1)">
                                                                                        </label>
                                                                                    </fieldset>
                                                                                    <div class="form-group"
                                                                                        style="display:none;"
                                                                                        id="pay_now_1">
                                                                                        <label for="projectinput3">خصم
                                                                                            من:</label>
                                                                                        <select
                                                                                            class="select2-rtl form-control"
                                                                                            data-placeholder="الخزنة"
                                                                                            name="later[1][safe_id]"
                                                                                            id="sel_xx_1">
                                                                                            <option></option>
                                                                                            @foreach ($project->allSafes() as $safe)
                                                                                                <option
                                                                                                    value="{{ $safe->id }}">
                                                                                                    {{ $safe->safe_name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                        @else
                                                                            @foreach ($project->datesInProject as $key2 => $item)
                                                                                <tr>
                                                                                    <th scope="row">
                                                                                        <div class="form-group">
                                                                                            <input type="number"
                                                                                                class="form-control dof3aSum"
                                                                                                placeholder="أدخل المبلغ"
                                                                                                name="later[{{ $key2 + 1 }}][amount]"
                                                                                                value="{{ $item->amount }}"
                                                                                                @if ($item->paid != 'No') readonly @endif>
                                                                                        </div>
                                                                                    </th>
                                                                                    <td>
                                                                                        <fieldset class="form-group">
                                                                                            <input type="date"
                                                                                                class="form-control"
                                                                                                name="later[{{ $key2 + 1 }}][date]"
                                                                                                value="{{ $item->date }}"
                                                                                                @if ($item->paid != 'No') readonly @endif>
                                                                                        </fieldset>
                                                                                        <fieldset class="form-group">
                                                                                            <div class="label">الملاحظات
                                                                                            </div>
                                                                                            <textarea class="form-control"
                                                                                                rows="3"
                                                                                                placeholder="مثال: الدفعه المقدمة"
                                                                                                name="later[{{ $key2 + 1 }}][notes]"
                                                                                                @if ($item->paid != 'No') readonly @endif>{{ $item->notes }}</textarea>
                                                                                        </fieldset>
                                                                                    </td>

                                                                                    <td>
                                                                                        @if ($item->paid != 'No')
                                                                                            <p class="text-success"> <input
                                                                                                    type="checkbox"
                                                                                                    name="later[{{ $key2 + 1 }}][paynow]"
                                                                                                    checked
                                                                                                    onclick="return false;" />
                                                                                                تم الدفع</p>
                                                                                            <p><label>رقم ايصال الدفع:
                                                                                                </label>
                                                                                                {{ $item->safe_payment_id }}
                                                                                            </p>
                                                                                            <button class="btn btn-dark"
                                                                                                type="button"
                                                                                                onclick="return pay('{{ route('safes.receipt', $item->safe_payment_id) }}');">استعراض
                                                                                                الإيصال</button>
                                                                                            <input type="hidden" id=""
                                                                                                class="form-control"
                                                                                                placeholder="رقم العملية في الخزنة"
                                                                                                name="later[{{ $key2 + 1 }}][safe_payment_id]"
                                                                                                value="{{ $item->safe_payment_id }}">
                                                                                            <input type="hidden"
                                                                                                name="later[{{ $key2 + 1 }}][safe_id]"
                                                                                                value="{{ $item->safe_id }}">
                                                                                        @else
                                                                                            <fieldset class="checkboxsas">
                                                                                                <label>
                                                                                                    دفع الان
                                                                                                    <input type="checkbox"
                                                                                                        name="later[{{ $key2 + 1 }}][paynow]"
                                                                                                        onchange="return payNow({{ $key2 + 1 }})">
                                                                                                </label>
                                                                                            </fieldset>
                                                                                            <div class="form-group"
                                                                                                style="display:none;"
                                                                                                id="pay_now_{{ $key2 + 1 }}">
                                                                                                <label
                                                                                                    for="projectinput3">خصم
                                                                                                    من:</label>
                                                                                                <select
                                                                                                    class="select2-rtl form-control"
                                                                                                    data-placeholder="الخزنة"
                                                                                                    name="later[{{ $key2 + 1 }}][safe_id]"
                                                                                                    id="sel_xx_{{ $key2 + 1 }}">
                                                                                                    <option></option>
                                                                                                    @foreach ($project->allSafes() as $safe)
                                                                                                        <option
                                                                                                            value="{{ $safe->id }}">
                                                                                                            {{ $safe->safe_name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        @endif




                                                                                        {{-- <fieldset class="checkboxsas">
                                                                                                <label>
                                                                                                    مدفوعه
                                                                                                  <input type="checkbox" name="later[{{$key2+1}}][paid]" @if ($item->paid != 'No') checked  @endif onchange="return laterPaid({{$key2+1}})">
                                                                                                </label>
                                                                                            </fieldset> --}}


                                                                                        {{-- <div id="later_dates_{{$key2+1}}" @if ($item->paid != 'No') style="display: block" @else style="display:none;"  @endif>
                                                                                            <div class="form-group">
                                                                                                <div class="label">رقم العملية في الخزنة:</div>
                                                                                                <input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[{{$key2+1}}][safe_payment_id]" value="{{$item->safe_payment_id}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="projectinput3">خصمت من:</label>
                                                                                                <select class="select2-rtl form-control" data-placeholder="تعديل" name="later[{{$key2+1}}][safe_id]">
                                                                                                    @if ($item->paid != 'No')
                                                                                                        @if ($item->safe_id)
                                                                                                    <option value="{{$item->safe_id}}">{{$item->safe->safe_name}}</option>
                                                                                                        @else
                                                                                                        <option></option>
                                                                                                        @endif
                                                                                                    @else
                                                                                                    <option></option>
                                                                                                    @endif
                                                                                                    @foreach ($project->allSafes() as $safe)
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
                                                <div class="form-group mt-3">
                                                    @if ($project->step == 4)
                                                        <button type="button" onclick="return updateProj(4)"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">الإنتقال لفواتير المشتريات</button>
                                                    @else
                                                        <button type="button" onclick="stepsWizard.steps('next')"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">التالي</a>
                                                    @endif
                                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                        style="float: left">حفظ و عودة لاحقا</button>
                                                </div>
                                            </fieldset>
                                            <!-- Step 4 -->
                                            <h6><i class="step-icon la la-files-o"></i>فواتير المشتريات</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <button type="button"
                                                                class="btn mb-1 btn-success btn-icon btn-lg btn-block"
                                                                data-toggle="modal" data-target="#xlarge">
                                                                <i class="la la-plus-circle"></i>
                                                                أضف فاتورة جديدة
                                                            </button>
                                                            <div class="modal fade text-left" id="xlarge" tabindex="-1"
                                                                role="dialog" aria-labelledby="myModalLabel16"
                                                                aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-xl" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title" id="myModalLabel16">
                                                                                إضافة فاتورة مشتريات</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h5>تفاصيل الفاتورة</h5>





                                                                            <div class="row">
                                                                                <div class="col-md-8">
                                                                                    <div class="card">
                                                                                        <div
                                                                                            class="card-content collapse show">
                                                                                            <div class="card-body">

                                                                                                <div class="form-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-6"
                                                                                                            style="border-left: 6px solid #28d094;
                                                                                                height: 140px;">
                                                                                                            <div
                                                                                                                class="form-group">
                                                                                                                <div
                                                                                                                    class="text-bold-600 font-medium-2">
                                                                                                                    اختر
                                                                                                                    المورد
                                                                                                                </div>
                                                                                                                <select
                                                                                                                    class="select2-rtl form-control"
                                                                                                                    data-placeholder="إختر المورد..."
                                                                                                                    name="supplier_id"
                                                                                                                    id="supplier_id"
                                                                                                                    required>
                                                                                                                    <option>
                                                                                                                    </option>
                                                                                                                    @foreach ($suppliers as $supplier)
                                                                                                                        <option
                                                                                                                            value="{{ $supplier->id }}">
                                                                                                                            {{ $supplier->supplier_name }}
                                                                                                                            @if (isset($supplier->supplier_company))
                                                                                                                                -
                                                                                                                                {{ $supplier->supplier_company }}
                                                                                                                            @endif
                                                                                                                        </option>
                                                                                                                    @endforeach
                                                                                                                    each
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-md-6">
                                                                                                            <div
                                                                                                                class="form-group">
                                                                                                                <div
                                                                                                                    class="text-bold-600 font-medium-2">
                                                                                                                    مورد
                                                                                                                    جديد
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        class="form-control"
                                                                                                                        name="new_supplier_name"
                                                                                                                        id="new_supplier_name"
                                                                                                                        placeholder="اسم المورد"
                                                                                                                        onblur="return chooseSupplierType()" />
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        class="form-control"
                                                                                                                        name="new_supplier_mobile"
                                                                                                                        id="new_supplier_mobile"
                                                                                                                        placeholder="موبايل المورد"
                                                                                                                        onblur="return chooseSupplierType()" />
                                                                                                                    <small
                                                                                                                        id="supplierHelp"
                                                                                                                        class="text-danger"
                                                                                                                        style="display: none">
                                                                                                                        هذا
                                                                                                                        الرقم
                                                                                                                        مسجل
                                                                                                                        بالفعل
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
                                                                                        <div
                                                                                            class="card-content collapse show">
                                                                                            <div class="card-body">
                                                                                                <ul
                                                                                                    class="nav nav-tabs nav-top-border no-hover-bg">
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link active"
                                                                                                            id="xxx_base-tab11"
                                                                                                            data-toggle="tab"
                                                                                                            aria-controls="xxx_tab11"
                                                                                                            href="#xxx_tab11"
                                                                                                            aria-expanded="true">الخصم</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link"
                                                                                                            id="xxx_base-tab13"
                                                                                                            data-toggle="tab"
                                                                                                            aria-controls="xxx_tab13"
                                                                                                            href="#xxx_tab13"
                                                                                                            aria-expanded="false">الشحن</a>
                                                                                                    </li>
                                                                                                    <li class="nav-item">
                                                                                                        <a class="nav-link"
                                                                                                            id="xxx_base-tab14"
                                                                                                            data-toggle="tab"
                                                                                                            aria-controls="xxx_tab14"
                                                                                                            href="#xxx_tab14"
                                                                                                            aria-expanded="false">الضريبة</a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                                <div
                                                                                                    class="tab-content px-1 pt-1">
                                                                                                    <div role="tabpanel"
                                                                                                        class="tab-pane active"
                                                                                                        id="xxx_tab11"
                                                                                                        aria-expanded="true"
                                                                                                        aria-labelledby="xxx_base-tab11">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-4"
                                                                                                                id="xxx_dis_per">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        for="projectinput3">الخصم</label>
                                                                                                                    <input
                                                                                                                        type="number"
                                                                                                                        id="xxx_curr_per"
                                                                                                                        class="form-control"
                                                                                                                        placeholder=""
                                                                                                                        name="discount_percentage"
                                                                                                                        value="0"
                                                                                                                        min="0"
                                                                                                                        max="100"
                                                                                                                        onblur="return calculateDiscountxxx(1)">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-4"
                                                                                                                style="display: none"
                                                                                                                id="xxx_dis_amount">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        for="projectinput3">الخصم</label>
                                                                                                                    <input
                                                                                                                        type="number"
                                                                                                                        id="xxx_curr_amount"
                                                                                                                        class="form-control"
                                                                                                                        placeholder=""
                                                                                                                        name="discount_amount"
                                                                                                                        value="0"
                                                                                                                        min="0"
                                                                                                                        onblur="return calculateDiscountxxx(2)">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-md-8">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        for="projectinput3">النوع</label>

                                                                                                                    <select
                                                                                                                        class="form-control"
                                                                                                                        onchange="return changeDisTypexxx(this)">
                                                                                                                        <option
                                                                                                                            value="percent">
                                                                                                                            نسبة
                                                                                                                            مئوية
                                                                                                                            (%)
                                                                                                                        </option>
                                                                                                                        <option
                                                                                                                            value="fixed">
                                                                                                                            المبلغ
                                                                                                                        </option>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="tab-pane"
                                                                                                        id="xxx_tab13"
                                                                                                        aria-labelledby="xxx_base-tab13">
                                                                                                        <div class="row">
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        for="projectinput3">مصاريف
                                                                                                                        الشحن</label>
                                                                                                                    <input
                                                                                                                        type="number"
                                                                                                                        id="xxx_shipping_fees"
                                                                                                                        class="form-control"
                                                                                                                        placeholder=""
                                                                                                                        name="xxx_shipping_fees"
                                                                                                                        value="0"
                                                                                                                        onblur="return updateShippingxxx()"
                                                                                                                        required>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                    <div class="tab-pane"
                                                                                                        id="xxx_tab14"
                                                                                                        aria-labelledby="xxx_base-tab14">
                                                                                                        <div class="row">
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        for="projectinput3">نسبة
                                                                                                                        الضريبة</label>
                                                                                                                    <input
                                                                                                                        type="number"
                                                                                                                        id="xxx_tax_fees"
                                                                                                                        class="form-control"
                                                                                                                        placeholder=""
                                                                                                                        name="tax"
                                                                                                                        value="0"
                                                                                                                        onblur="return updateTaxxxx()"
                                                                                                                        required>
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
                                                                                        <div
                                                                                            class="card-content collapse show">
                                                                                            <div class="card-body">

                                                                                                <div
                                                                                                    class="table-responsive">
                                                                                                    <table
                                                                                                        class="table mb-0 table-bordered"
                                                                                                        id="xxxmyTable"
                                                                                                        style="overflow: hidden;">
                                                                                                        <thead
                                                                                                            class="bg-yellow bg-lighten-4">
                                                                                                            <tr>
                                                                                                                <th
                                                                                                                    style="width: 250px">
                                                                                                                    البند
                                                                                                                </th>
                                                                                                                <th>الوصف</span>
                                                                                                                    <span
                                                                                                                        class="tooltip">
                                                                                                                        <a href="#"
                                                                                                                            tabindex="-1"><img
                                                                                                                                src="/css/images/question-ar.png"
                                                                                                                                class="tips-image"></a>
                                                                                                                    </span>
                                                                                                                </th>
                                                                                                                <th>سعر
                                                                                                                    الوحدة
                                                                                                                </th>
                                                                                                                <th>الكمية
                                                                                                                </th>
                                                                                                                <th>المجموع
                                                                                                                </th>
                                                                                                                <th></th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr
                                                                                                                id="xxx_row_1">
                                                                                                                <td>
                                                                                                                    <div
                                                                                                                        class="form-group product_sel">
                                                                                                                        <select
                                                                                                                            class="select2-rtl form-control"
                                                                                                                            data-placeholder="إختر المنتج"
                                                                                                                            name="product[1][id]"
                                                                                                                            required>
                                                                                                                            <option>
                                                                                                                            </option>
                                                                                                                            @foreach ($products as $product)
                                                                                                                                <option
                                                                                                                                    value="{{ $product->id }}">
                                                                                                                                    {{ $product->product_name }}
                                                                                                                                </option>
                                                                                                                            @endfor
                                                                                                                            each
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td><input
                                                                                                                        type="text"
                                                                                                                        class="product_input"
                                                                                                                        name="product[1][desc]" />
                                                                                                                </td>
                                                                                                                <td><input
                                                                                                                        type="number"
                                                                                                                        class="product_input"
                                                                                                                        id="xxx_p_p_1"
                                                                                                                        name="product[1][price]"
                                                                                                                        onblur="return reCalculatexxx(1)"
                                                                                                                        oninput="return numbersOnly(this)" />
                                                                                                                </td>
                                                                                                                <td><input
                                                                                                                        type="number"
                                                                                                                        class="product_input"
                                                                                                                        id="xxx_p_q_1"
                                                                                                                        name="product[1][qty]"
                                                                                                                        onblur="return reCalculatexxx(1)"
                                                                                                                        oninput="return numbersOnly(this)"
                                                                                                                        value="0" />
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <span
                                                                                                                        id="xxx_tot_1">0</span>
                                                                                                                    ج.م
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td colspan="2"
                                                                                                                    style="border-style: none !important;">
                                                                                                                    <div>
                                                                                                                        <button
                                                                                                                            type="button"
                                                                                                                            onclick="addFieldxxx()"
                                                                                                                            class="add-row btn m-b-xs btn-sm btn-success btn-addon btn-blue">
                                                                                                                            <i
                                                                                                                                class="la la-plus"></i>
                                                                                                                            إضافة
                                                                                                                            بند
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td colspan="2"
                                                                                                                    class="text-right"
                                                                                                                    style="border-style: none !important;">
                                                                                                                    <strong>الإجمالي</strong>
                                                                                                                </td>
                                                                                                                <td class="text-left"
                                                                                                                    style="border-style: none !important;">
                                                                                                                    <code><span
                                                                                                                            id="xxx_total_after_all">0</span></code>&nbsp;ج.م
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                            </tr>
                                                                                                            <tr id="xxx_hidden-row-1"
                                                                                                                style="display: none">
                                                                                                                <td colspan="4"
                                                                                                                    class="text-right">
                                                                                                                    <strong>
                                                                                                                        الخصم
                                                                                                                        (النسبة)[<span
                                                                                                                            id="xxx_discount_percentage"
                                                                                                                            style="color: goldenrod">0</span>%]</strong>
                                                                                                                </td>
                                                                                                                <td id="xxx_TotalValue"
                                                                                                                    class="text-left">
                                                                                                                    <code><span
                                                                                                                            id="xxx_discount_percentage_amount">0</span></code>&nbsp;ج.م
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                            </tr>
                                                                                                            <tr id="xxx_hidden-row-2"
                                                                                                                style="display: none">
                                                                                                                <td colspan="4"
                                                                                                                    class="text-right">
                                                                                                                    <strong>الخصم
                                                                                                                        (المبلغ)</strong>
                                                                                                                </td>
                                                                                                                <td id="xxx_TotalValue"
                                                                                                                    class="text-left">
                                                                                                                    <code><span
                                                                                                                            id="xxx_discount_amount">0</span></code>&nbsp;ج.م
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                            </tr>
                                                                                                            <tr id="xxx_hidden-row-3"
                                                                                                                style="display: none">
                                                                                                                <td colspan="4"
                                                                                                                    class="text-right">
                                                                                                                    <strong>الشحن</strong>
                                                                                                                </td>
                                                                                                                <td id="xxx_TotalValue"
                                                                                                                    class="text-left">
                                                                                                                    <code><span
                                                                                                                            id="xxx_shipping">0</span></code>&nbsp;ج.م
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                            </tr>
                                                                                                            <tr id="xxx_hidden-row-4"
                                                                                                                style="display: none">
                                                                                                                <td colspan="4"
                                                                                                                    class="text-right">
                                                                                                                    <strong>
                                                                                                                        الضريبة[<span
                                                                                                                            id="xxx_tax"
                                                                                                                            style="color: goldenrod">0</span>%]</strong>
                                                                                                                </td>
                                                                                                                <td
                                                                                                                    class="text-left">
                                                                                                                    <code><span
                                                                                                                            id="xxx_tax_amount">0</span></code>&nbsp;ج.م
                                                                                                                </td>
                                                                                                                <td></td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td colspan="4"
                                                                                                                    class="text-right">
                                                                                                                    <strong>الإجمالي</strong>
                                                                                                                </td>
                                                                                                                <td id="xxx_TotalValue"
                                                                                                                    class="text-left">
                                                                                                                    <code><span
                                                                                                                            id="xxx_total_after_all2">0</span></code>&nbsp;ج.م
                                                                                                                </td>
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
                                                                                        <div
                                                                                            class="card-content collapse show">
                                                                                            <div class="card-body">

                                                                                                <fieldset
                                                                                                    class="form-group">
                                                                                                    <p class="text-muted">
                                                                                                        الشروط / الملاحظات
                                                                                                    </p>
                                                                                                    <textarea
                                                                                                        class="form-control"
                                                                                                        name="purchase_note"
                                                                                                        rows="5"
                                                                                                        id="xxx_terms-conditions"></textarea>
                                                                                                </fieldset>


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>





















                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn grey btn-outline-secondary"
                                                                                data-dismiss="modal">إغلاق</button>
                                                                            <button type="button"
                                                                                class="btn btn-outline-primary">حفظ</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>تاريخ الفاتورة</th>
                                                                        <th>إجمالي الفاتورة</th>
                                                                        <th>التحكم</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">1</th>
                                                                        <td>03/04/2021</td>
                                                                        <td>5698 ج.م</td>
                                                                        <td>
                                                                            <button
                                                                                class="btn btn-success btn-sm">استعراض</button>
                                                                            <button
                                                                                class="btn btn-danger btn-sm">حذف</button>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    @if ($project->step == 5)
                                                        <button type="button" onclick="return updateProj(5)"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">الإنتقال للملحقات</button>
                                                    @else
                                                        <button type="button" onclick="stepsWizard.steps('next')"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">التالي</a>
                                                    @endif
                                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                        style="float: left">حفظ و عودة لاحقا</button>
                                                </div>
                                            </fieldset>
                                            <!-- Step 4 -->
                                            <h6><i class="step-icon la la-link"></i>الملحقات</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <fieldset class="form-group">
                                                            <label>أرفق ملف ملحق</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="mol7kat[]"
                                                                    class="custom-file-input" id="inputGroupFile02"
                                                                    multiple>
                                                                <label class="custom-file-label" for="inputGroupFile02"
                                                                    aria-describedby="inputGroupFile02">اختر الملف </label>
                                                            </div>
                                                        </fieldset>
                                                    </div>

                                                    <div class="col-md-6">
                                                        @if ($attachmentFiles->count() > 0)
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>اسم الملف</th>
                                                                            <th>نوع الملف</th>
                                                                            <th>التحكم</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($attachmentFiles as $key4 => $item)
                                                                            <tr>
                                                                                <th scope="row">{{ ++$key4 }}</th>
                                                                                <td>{{ $item->file_name }}</td>
                                                                                <td>{{ $item->file_ext }}</td>
                                                                                <td>
                                                                                    <a target="_blank"
                                                                                        href="/uploads/{{ $item->file_path }}"
                                                                                        class="btn btn-success btn-sm">استعراض</a>
                                                                                    <button
                                                                                        class="btn btn-danger btn-sm">حذف</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <p class="text-center text-danger mt-3">لا توجد ملفات مرفوعه</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group mt-3">
                                                    @if ($project->step == 6)
                                                        <button type="button" onclick="return updateProj(6)"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">إنهاء المشروع</button>
                                                    @else
                                                        <button type="button" onclick="stepsWizard.steps('prev')"
                                                            class="btn mb-1 btn-secondary btn-lg btn-glow"
                                                            style="float: left">السابق</a>
                                                    @endif
                                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow"
                                                        style="float: left">حفظ و عودة لاحقا</button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
        <!-- users view card data ends -->

        </section>
        <!-- users view ends -->
    </div>
    </div>



    @include('common.footer')
@endsection


@section('pageJs')




    <!-- BEGIN: Theme JS-->

    <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script src="{{ asset('theme/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Theme JS-->



    <script>
        function updateProj(oldStep) {
            $('#theStep').val(oldStep + 1);
            $('#returnHere').val(1);
            $('#mashroo3').submit();
        }






        var nextAllowed = $('#theStep').val();
        nextAllowed = parseInt(nextAllowed);
        if (nextAllowed == 7) {
            nextAllowed = 6;
        }
        stepsWizard = $(".icons-tab-steps").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            enableKeyNavigation: false,
            enablePagination: false,
            labels: {
                finish: "حفظ"
            },
            saveState: true,
            startIndex: nextAllowed,
            onStepChanging: function(event, currentIndex, newIndex) {
                if (newIndex < currentIndex) return true;
                if (newIndex > currentIndex) {
                    // if(nextAllowed <= newIndex){
                    if (newIndex <= nextAllowed) {
                        return true;
                    }
                }
                // if(currentIndex == 0){
                //     if(nextAllowed == 1){
                //         return true;
                //      }else{
                //          alert('أكمل البيانات');
                //          return false;
                //          }
                // }
            },
            onFinished: function(e, t) {
                alert("Form submitted.")
            }
        })





        function getProductInfo(product, row) {

            var branch_id = 1;

            var get_branch_id = $('#branch_id').val();

            if (get_branch_id > 0) {
                branch_id = get_branch_id;
            } else {
                branch_id = 1;
            }
            if (isNaN(product.value)) {
                $("#p_q_" + row).attr({
                    "placeholder": "صنف غير موجود"
                });
            } else {
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
                        //  $("#p_q_"+row).attr({"max" : data.amount });
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
                        $("#addingRowBtn").prop("disabled", false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }


            //currentProductIds.push(product.value);

            // console.log(currentProductIds);

        }


        $(document).ready(function() {
            if ({{ $key }} != 0) {
                for (let index = 1; index < {{ $key + 2 }}; index++) {
                    reCalculate(index);
                    $('#sel_x_' + index).select2({
                        allowClear: false,
                        tags: true
                    });
                }
            }




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
            updateTotal();
            $("#tot_" + rowNum).closest('tr').remove();

            //currentProductIds.pop(1);
        }


        $('#payment_method').on('change', function() {
            if (this.value == 'later') {
                //$('#init_box').hide();
                //$('#other_box').hide();
                $('#later_box').show();
                $('#hasPaid').prop("checked", false);

            } else if (this.value == 'cash' || this.value == 'visa' || this.value == 'bankTransfer') {
                //$('#init_box').hide();
                $('#later_box').hide();
                //$('#other_box').show();
                $('#hasPaid').prop("checked", true);
            } else {
                $('#later_box').hide();
                //$('#other_box').hide();
                $('#init_box').show();
                $('#hasPaid').prop("checked", false);
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
            currentCell.innerHTML = '<fieldset class="form-group"><input type="date" class="form-control"  name="later[' +
                currentIndex +
                '][date]" required></fieldset><fieldset class="form-group"><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[' +
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
            product_qty.setAttribute("type", "number");
            product_qty.setAttribute("min", "0");
            product_qty.setAttribute("class", "product_input");
            product_qty.setAttribute("id", "p_q_" + currentIndex);
            product_qty.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
            product_qty.setAttribute("placeholder", "0");

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex +
                '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[' + currentIndex +
                '][id]" required onchange="return getProductInfo(this,' + currentIndex +
                ')"><option></option> @foreach ($products as $product) <option value="{{ $product->id }}">{{ $product->product_name }}</option>  @endforeach</select></div>';

            //currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_x_' + currentIndex + '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product['+currentIndex+'][id]" required onchange="return getProductInfo(this,'+currentIndex+')"> </select></div>';


            $('#sel_x_' + currentIndex).select2({
                allowClear: false,
                tags: true
            });

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


        //////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////
        ///////////////////// JS for Purchase Orders /////////////////////
        //////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////

        function addFieldxxx(argument) {
            var myTable = document.getElementById("xxxmyTable");
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
            product_price.setAttribute("type", "number");
            product_price.setAttribute("id", "xxx_p_p_" + currentIndex);
            product_price.setAttribute("oninput", "return numbersOnly(this)");
            product_price.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
            product_price.setAttribute("required", "required");


            var product_qty = document.createElement("input");
            product_qty.setAttribute("name", "product[" + currentIndex + "][qty]");
            product_qty.setAttribute("class", "product_input");
            product_qty.setAttribute("type", "number");
            product_qty.setAttribute("id", "xxx_p_q_" + currentIndex);
            product_qty.setAttribute("oninput", "return numbersOnly(this)");
            product_qty.setAttribute("onblur", "return reCalculate(" + currentIndex + ")");
            product_qty.setAttribute("value", "0");
            product_qty.setAttribute("required", "required");

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML = '<div class="form-group product_sel"><select id="sel_xxx_' + currentIndex +
                '" class="select2-rtl form-control" data-placeholder="إختر المنتج" name="product[' + currentIndex +
                '][id]" required><option></option> @foreach ($products as $product) <option value="{{ $product->id }}">{{ $product->product_name }}</option>@endforeach</select></div>';
            $('#sel_xxx_' + currentIndex).select2();

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(product_desc);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(product_price);

            currentCell = currentRow.insertCell(-1);
            currentCell.appendChild(product_qty);

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML = ' <span id="xxx_tot_' + currentIndex + '">0</span> ج.م';

            var currentCell = currentRow.insertCell(-1);
            currentCell.innerHTML =
                '<center><button type="button" class="btn btn-danger btn-sm" onclick="return delRowxxx(' +
                currentIndex + ')" style="vertical-align:center">X</button></center>';
        }


        function reCalculatexxx(rowNum) {
            var oldRowTotal = $("#xxx_tot_" + rowNum).text();
            oldRowTotal = parseInt(oldRowTotal);
            var price = $("#xxx_p_p_" + rowNum).val();
            var qty = $("#xxx_p_q_" + rowNum).val();
            var rowTotal = price * qty;
            $('#xxx_tot_' + rowNum).text(rowTotal);
            var currentTotal = $("#xxx_total_after_all").text();
            currentTotal = parseInt(currentTotal);
            var newTotal = currentTotal - oldRowTotal;
            newTotal = newTotal + rowTotal;
            //Subtotal
            $('#xxx_total_after_all').text(newTotal);

            updateDiscountxxx();
            updateShippingxxx();
            updateTaxxxx();

            updateTotalxxx();
        }



        function delRowxxx(rowNum) {
            var oldRowTotal = $("#xxx_tot_" + rowNum).text();
            oldRowTotal = parseInt(oldRowTotal);
            var currentTotal = $("#xxx_total_after_all").text();
            currentTotal = parseInt(currentTotal);
            var newTotal = currentTotal - oldRowTotal;
            //sub total
            $('#xxx_total_after_all').text(newTotal);
            updateDiscountxxx();
            updateShippingxxx();
            updateTaxxxx();

            updateTotalxxx();
            $("#xxx_tot_" + rowNum).closest('tr').remove();

        }



        function updateShippingxxx() {
            newShipping = $('#xxx_shipping_fees').val();
            if ($('#xxx_shipping_fees').val().length === 0) {
                newShipping = 0;
            }
            if (newShipping > 0) {
                $('#xxx_hidden-row-3').show();
            } else {
                $('#xxx_hidden-row-3').hide();
            }
            $('#xxx_shipping').html(newShipping);
            updateTotalxxx();
        }


        function calculateDiscountxxx(theType) {
            //clear old discount
            $('#xxx_discount_percentage').text(0);
            $('#xxx_discount_percentage_amount').text(0);
            $('#xxx_discount_amount').text(0);
            // if discount type is percentage
            if (theType == 1) {
                var theValue = $('#xxx_curr_per').val();
                if ($('#xxx_curr_per').val().length === 0) {
                    theValue = 0;
                }
                if (theValue > 0) {
                    $('#xxx_hidden-row-1').show();
                } else {
                    $('#xxx_hidden-row-1').hide();
                }
                $('#xxx_curr_amount').val(0);
                var currentDiscountP = $('#xxx_discount_percentage').text();
                currentDiscountP = parseInt(currentDiscountP);
                var currentInvoiceTotal = $("#xxx_total_after_all").text();
                currentInvoiceTotal = parseInt(currentInvoiceTotal);
                var newInvoiceTotal = currentInvoiceTotal - (currentInvoiceTotal * (theValue / 100));
                var discount_amount = currentInvoiceTotal - newInvoiceTotal;
                discount_amount = Math.round(discount_amount);
                $('#xxx_discount_percentage').text(theValue);
                $('#xxx_discount_percentage_amount').text(discount_amount);
            }
            //if discount type is fixed
            else if (theType == 2) {
                var theValue = $('#xxx_curr_amount').val();
                if ($('#xxx_curr_amount').val().length === 0) {
                    theValue = 0;
                }
                if (theValue > 0) {
                    $('#xxx_hidden-row-2').show();
                } else {
                    $('#xxx_hidden-row-2').hide();
                }
                $('#xxx_curr_per').val(0);
                var currentDiscountA = $('#xxx_discount_amount').text();
                currentDiscountA = parseInt(currentDiscountA);
                var currentInvoiceTotal = $("#xxx_total_after_all").text();
                currentInvoiceTotal = parseInt(currentInvoiceTotal);
                var newInvoiceTotal = parseInt(currentInvoiceTotal) + parseInt(currentDiscountA) - parseInt(theValue);
                $('#xxx_discount_amount').text(theValue);
            }
            updateTotalxxx();
        }



        function changeDisTypexxx(type) {
            if (type.value == 'fixed') {
                $('#xxx_dis_per').hide();
                $('#xxx_dis_amount').show();
            } else {
                $('#xxx_dis_amount').hide();
                $('#xxx_dis_per').show();
            }
        }


        function updateDiscountxx() {
            var discount_percentage = $('#xxx_curr_per').val();
            var discount_amount = $('#xxx_curr_amount').val();
            if (discount_percentage > 0) {
                discount_percentage = parseInt(discount_percentage);
                calculateDiscountxxx(1, discount_percentage);
            }

            if (discount_amount > 0) {
                discount_amount = parseInt(discount_amount);
                calculateDiscountxxx(2, discount_amount);
            }

        }


        function updateTotalxxx() {

            //get sub total
            var getSubTotal = $("#xxx_total_after_all").text();
            getSubTotal = parseInt(getSubTotal);
            //get discount amount
            var getDiscountAmount_1 = $('#xxx_discount_percentage_amount').text();
            var getDiscountAmount_2 = $('#xxx_discount_amount').text();
            getDiscountAmount_1 = parseInt(getDiscountAmount_1);
            getDiscountAmount_2 = parseInt(getDiscountAmount_2);
            //get shipping
            var getShipping = $('#xxx_shipping').text();
            getShipping = parseInt(getShipping);
            //get Tax
            var getTax = $('#xxx_tax_amount').text();
            getTax = parseInt(getTax);
            //add them all
            var invoiceTotal = getSubTotal + getShipping + getTax - getDiscountAmount_1 - getDiscountAmount_2;
            $('#xxx_total_after_all2').text(invoiceTotal);
            $('#xxx_totalToSave').val(invoiceTotal);

        }



        function payNowxxx(row) {
            if ($('#xxx_pay_now_' + row + ':visible').length == 0) {
                $('#xxx_pay_now_' + row).show();
            } else {
                $('#xxx_pay_now_' + row).hide();
            }
        }



        CKEDITOR.ClassicEditor.create(document.querySelector('#xxx_terms-conditions')).catch(error => {
            console.error(error);
        });




        function updateTaxxxx() {
            newTax = $('#xxx_tax_fees').val();
            if ($('#xxx_tax_fees').val().length === 0) {
                newTax = 0;
            }
            if (newTax > 0) {
                $('#xxx_hidden-row-4').show();
            } else {
                $('#xxx_hidden-row-4').hide();
            }

            var currentInvoiceTotal = $("#xxx_total_after_all").text();
            currentInvoiceTotal = parseInt(currentInvoiceTotal);
            var newInvoiceTotal = currentInvoiceTotal - (currentInvoiceTotal * (newTax / 100));
            var taxAmount = currentInvoiceTotal - newInvoiceTotal;
            taxAmount = Math.round(taxAmount);
            $('#xxx_tax_amount').text(taxAmount);

            $('#xxx_tax').html(newTax);
            updateTotalxxx();
        }



        function updateDiscountxxx() {
            var discount_percentage = $('#xxx_curr_per').val();
            var discount_amount = $('#xxx_curr_amount').val();
            if (discount_percentage > 0) {
                discount_percentage = parseInt(discount_percentage);
                calculateDiscountxxx(1, discount_percentage);
            }

            if (discount_amount > 0) {
                discount_amount = parseInt(discount_amount);
                calculateDiscountxxx(2, discount_amount);
            }

        }




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

    </script>

    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/wizard-steps.min.js') }}"></script> --}}
    <script src="{{ asset('theme/app-assets/js/scripts/forms/custom-file-input.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>


@endsection
