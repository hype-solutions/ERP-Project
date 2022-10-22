@extends('layouts.erp')
@section('title', 'ملف عميل - ' . $customer->customer_name)

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
        href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <!-- END: Vendor CSS-->
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
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('customers.list') }}">العملاء</a></li>
                                    <li class="breadcrumb-item active">ملف عميل
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="media mb-2">
                            <a class="mr-1" href="#">
                                <img src="{{ asset('theme/app-assets/images/custom/client.svg') }}"
                                    alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64"
                                    width="64">
                            </a>
                            <div class="media-body pt-25">
                                <h4 class="media-heading"><span class="users-view-name">{{ $customer->customer_name }}
                                    </span>
                                </h4>
                                <span>رقم العميل:</span>
                                <span class="users-view-id">
                                    <span class="badge badge-success users-view-status">{{ $customer->id }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        <div class="btn-group mr-1 mb-1">
                            <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <a class="dropdown-item" href="{{ route('customers.view', $customer->id) }}">استعراض
                                    الملف</a>
                                <a class="dropdown-item" href="{{ route('customers.edit', $customer->id) }}">تعديل
                                    الملف</a>
                                <a class="dropdown-item" href="{{ route('invoices.add') }}">فاتورة جديد</a>
                                <a class="dropdown-item" href="{{ route('invoicespricequotations.add') }}">عرض سعر
                                    جديد</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('customers.delete', $customer->id) }}" method="post"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل نهائيا و جميع تفاصيله من البرنامج')">
                                    @csrf
                                    @method('delete')
                                    <button class="dropdown-item btn-danger btn" type="submit">حذف العميل</button>
                                </form>
                            </div>
                        </div>
                        <div class="btn-group mr-1 mb-1">
                            <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التواصل مع
                                العميل</button>
                            <div class="dropdown-menu" x-placement="bottom-start"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                @if (isset($customer->customer_mobile))
                                    <a class="dropdown-item" href="tel:{{ $customer->customer_mobile }}">اتصال
                                        بالموبايل</a>
                                @else
                                    <button class="dropdown-item" href="#">اتصال بالموبايل</button>
                                @endif
                                @if (isset($customer->customer_phone))
                                    <a class="dropdown-item" href="tel:{{ $customer->customer_phone }}">اتصال
                                        بالتليفون</a>
                                @else
                                    <button class="dropdown-item" href="#">اتصال بالتليفون</button>
                                @endif
                                <button class="dropdown-item" disabled>ارسال SMS <small style="color: red">غير
                                        متاحة</small></button>
                                @if (isset($customer->customer_email))
                                    <a class="dropdown-item" href="mailto:{{ $customer->customer_email }}"> ارسال
                                        ايميل</a>
                                @else
                                    <button class="dropdown-item" href="#"> ارسال ايميل</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view media object ends -->
                <!-- users view card data start -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            {{-- <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات الشراء: <span class="font-large-1 align-middle">125</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات عرض السعر: <span class="font-large-1 align-middle">534</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">إجمالي المبالغ من الفواتير: <span class="font-large-1 align-middle">256 جنية</span></h6>
            </div>
          </div> --}}
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>نوع العميل:</td>
                                                <td>
                                                    @if ($customer->customer_type == 'company')
                                                        تجاري
                                                    @elseif ($customer->customer_type == 'solo')
                                                        فردي
                                                    @elseif ($customer->customer_type == 'agent')
                                                        وسيط
                                                    @endif
                                                </td>
                                            </tr>
                                            @if ($customer->customer_type == 'company')
                                                <tr>
                                                    <td>اسم الشركة:</td>
                                                    <td>
                                                        @if (isset($customer->customer_company))
                                                            {{ $customer->customer_company }}
                                                        @else
                                                            <small style="font-style: italic;color:red;">غير مسجل</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td> ممثل الشركة:</td>
                                                    <td>{{ $customer->customer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>المسمى الوظيفي:</td>
                                                    <td>
                                                        @if (isset($customer->customer_title))
                                                            {{ $customer->customer_title }}
                                                        @else
                                                            <small style="font-style: italic;color:red;">غير مسجل</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>السجل التجاري:</td>
                                                    <td>
                                                        @if (isset($customer->customer_commercial_registry))
                                                            {{ $customer->customer_commercial_registry }}
                                                        @else
                                                            <small style="font-style: italic;color:red;">غير مسجل</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>البطاقة الضريبية:</td>
                                                    <td>
                                                        @if (isset($customer->customer_tax_card))
                                                            {{ $customer->customer_tax_card }}
                                                        @else
                                                            <small style="font-style: italic;color:red;">غير مسجل</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @elseif ($customer->customer_type == 'solo')
                                                <tr>
                                                    <td>اسم العميل:</td>
                                                    <td>{{ $customer->customer_name }}</td>
                                                </tr>
                                            @elseif ($customer->customer_type == 'agent')
                                                <tr>
                                                    <td>اسم الوسيط:</td>
                                                    <td>{{ $customer->customer_name }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td>الموبايل:</td>
                                                <td>{{ $customer->customer_mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td>التليفون:</td>
                                                <td>
                                                    @if (isset($customer->customer_phone))
                                                        {{ $customer->customer_phone }}
                                                    @else
                                                        <small style="font-style: italic;color:red;">غير مسجل</small>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>الايميل:</td>
                                                <td>
                                                    @if (isset($customer->customer_email))
                                                        {{ $customer->customer_email }}
                                                    @else
                                                        <small style="font-style: italic;color:red;">غير مسجل</small>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>العنوان:</td>
                                                <td>
                                                    @if (isset($customer->customer_address))
                                                        {{ $customer->customer_address }}
                                                    @else
                                                        <small style="font-style: italic;color:red;">غير مسجل </small>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                                <div class="col-xl-6 col-lg-12 mb-1">
                                    <div class="form-group text-center">
                                        <!-- Floating Outline button with text -->
                                        <a type="button" class="btn btn-float btn-outline-cyan" id="invoiceNav"
                                            style="cursor: context-menu"><i
                                                class="">{{ $customerInvoicesCount + $customerPosSalesCount }}</i><span>عدد
                                                فواتير
                                                الشراء</span>
                                            <br>
                                            <small>{{ $customerPosSalesCount }} بيع سريع - {{ $customerInvoicesCount }}
                                                فواتير مبيعات</small>
                                            </a>
                                        <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"
                                            style="cursor: context-menu"><i
                                                class="">{{ $customerInvoicesSum }} ج,م</i><span>إجمالي
                                                المبالغ من الفواتير</span></button>
                                        <button type="button" class="btn btn-float btn-outline-cyan" id="pQuotationNav"
                                            style="cursor: context-menu"><i
                                                class="">{{ $customerPriceQuotationCount }}</i><span>عدد
                                                عروض
                                                الأسعار</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- users view card data ends -->
                <!-- users view card details start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4 class="card-title">Tab with Underline</h4> --}}
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg mb-3">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="link-link" data-toggle="tab" href="#link"
                                                aria-controls="link" aria-expanded="true">فواتير البيع السريع</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="active-tab32" data-toggle="tab" href="#active32"
                                                aria-controls="active32" aria-expanded="false">فواتير المبيعات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="link-tab32" data-toggle="tab" href="#link32"
                                                aria-controls="link32" aria-expanded="false">عروض الأسعار</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="link-tab35" data-toggle="tab" href="#link35"
                                                aria-controls="link35" aria-expanded="false">المبالغ المستحقة
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="linkOpt-tab2" data-toggle="tab" href="#linkOpt2"
                                                aria-controls="linkOpt2">الأصناف الأكثر طلبا
                                            </a>
                                        </li>
                                        @if ($customer->customer_type == 'company')
                                            <li class="nav-item">
                                                <a class="nav-link" id="linkOpt-tab2xx" data-toggle="tab"
                                                    href="#linkOpt2xx" aria-controls="linkOpt2xx">ممثلين / موظفين الشركة
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="link" aria-labelledby="link-link"
                                            aria-expanded="true">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="pos">
                                                    <thead>
                                                        <tr>
                                                            <th>رقم الفاتورة</th>
                                                            <th>إجمالي الفاتورة</th>
                                                            <th>التاريخ و الوقت</th>
                                                            <th>التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerPosSales as $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="badge border-info info badge-border">
                                                                        <a href="#" target="_blank"
                                                                            style="color: #1e9ff2"><span>{{ $item->id }}</span></a>
                                                                        <i class="la la-barcode font-medium-2"></i>
                                                                    </div>
                                                                    @if ($item->status == 2)
                                                                        <div
                                                                            class="badge border-danger danger badge-border">
                                                                            <a href="#" target="_blank"
                                                                                style="color: #dd1111"><span>مرتجعه</span></a>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->total }} ج.م</td>
                                                                <td>{{ $item->sold_when }}</td>

                                                                <td>
                                                                    @if ($item->status == 1)
                                                                        <a class="btn btn-success" style="width: max-content;"
                                                                            href="{{ route('pos.receipt', $item->id) }}"
                                                                            target="_blank">استعراض الفاتورة</a>
                                                                    @else
                                                                        <a class="btn btn-warning" style="width: max-content;"
                                                                            href="{{ route('pos.refund.receipt', $item->id) }}"
                                                                            target="_blank">استعراض فاتورة المرتجع</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="active32"
                                            aria-labelledby="active-tab32" aria-expanded="false">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="reciepts">
                                                    <thead>
                                                        <tr>
                                                            <th>رقم الفاتورة</th>
                                                            <th>التاريخ</th>
                                                            <th>الإجمالي</th>
                                                            <th>التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerInvoices as $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="badge border-info info badge-border">
                                                                        <a href="#" target="_blank"
                                                                            style="color: #1e9ff2"><span>{{ $item->id }}</span></a>
                                                                        <i class="la la-barcode font-medium-2"></i>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $item->invoice_date }}</td>
                                                                <td>{{ $item->invoice_total }} ج.م</td>
                                                                <td>
                                                                    <a class="btn btn-success" style="width: max-content;"
                                                                        href="{{ route('invoices.view', $item->id) }}"
                                                                        target="_blank">استعراض الفاتورة</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="link32" role="tabpanel" aria-labelledby="link-tab32"
                                            aria-expanded="false">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="quotations">
                                                    <thead>

                                                        <tr>
                                                            <th>رقم العرض</th>
                                                            <th>التاريخ</th>
                                                            <th>الإجمالي</th>
                                                            <th>الحالة</th>
                                                            <th>التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerPriceQuotation as $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="badge border-warning warning badge-border">
                                                                        <a href="#" target="_blank"
                                                                            style="color: #ff9149"><span>{{ $item->id }}</span></a>
                                                                        <i class="la la-barcode font-medium-2"></i>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $item->quotation_date }}</td>
                                                                <td>{{ $item->quotation_total }} ج.م</td>
                                                                <td>
                                                                    @if ($item->quotation_status == 'Pending')
                                                                        <div class="badge badge-warning">
                                                                            <i class="la la-money font-medium-2"></i>
                                                                            <span>قيد التنفيذ</span>
                                                                        </div>
                                                                    @elseif($item->quotation_status == 'Accepted')
                                                                        <div class="badge badge-success">
                                                                            <i class="la la-money font-medium-2"></i>
                                                                            <span>تمت الموافقة </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="badge badge-danger">
                                                                            <i class="la la-money font-medium-2"></i>
                                                                            <span>تم الرفض</span>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-success" style="width: max-content;"
                                                                        href="{{ route('invoicespricequotations.view', $item->id) }}"
                                                                        target="_blank">استعراض عرض السعر</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="link35" role="tabpanel"
                                            aria-labelledby="link-tab35" aria-expanded="false">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="due">
                                                    <thead>
                                                        <tr>
                                                            <th>رقم الفاتورة</th>
                                                            <th>تاريخ الإستحقاق</th>
                                                            <th>تم الدفع؟</th>
                                                            <th>الإجمالي</th>
                                                            <th>التحكم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerInvoicesPayments as $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="badge border-info info badge-border">
                                                                        <a href="#" target="_blank"
                                                                            style="color: #1e9ff2"><span>{{ $item->invoice_id }}</span></a>
                                                                        <i class="la la-barcode font-medium-2"></i>
                                                                    </div>
                                                                </td>
                                                                <td>{{ $item->date }}</td>
                                                                <td>
                                                                    @if ($item->paid == 'Yes')
                                                                        <span class="text-success">نعم</span>
                                                                    @else
                                                                        <span class="text-danger">لا</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->amount }} ج.م</td>
                                                                <td>
                                                                    @if ($item->paid == 'Yes')
                                                                        <a target="_blank" style="width: max-content;"
                                                                            href="{{ route('invoices.view', $item->id) }}"
                                                                            class="btn btn-primary">استعراض فاتورة
                                                                            البيع</a>
                                                                        <button class="btn btn-info">استعراض فاتورة
                                                                            التسديد</button>
                                                                    @else
                                                                        <a target="_blank" style="width: max-content;"
                                                                            href="{{ route('invoices.view', $item->id) }}"
                                                                            class="btn btn-primary">استعراض فاتورة
                                                                            البيع</a>
                                                                        <button class="btn btn-success" style="width: max-content;" data-toggle="modal"
                                                                            data-target="#pay">تحصيل الان</button>
                                                                        <button class="btn btn-warning">ارسال تذكير
                                                                            للعميل</button>

                                                                        <div class="modal fade text-left" id="pay"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="myModalLabel1"
                                                                            style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title"
                                                                                            id="myModalLabel1">إيداع</h4>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form class="form"
                                                                                            method="post"
                                                                                            action="{{ route('installments.paying') }}">
                                                                                            <input type="hidden"
                                                                                                name="installment_invoice"
                                                                                                value="{{ $item->id }}" />
                                                                                            <input type="hidden"
                                                                                                name="installment_type"
                                                                                                value="invoice">
                                                                                            <input type="hidden"
                                                                                                name="invoice_id"
                                                                                                value="{{ $item->invoice_id }}" />
                                                                                            @csrf
                                                                                            <div class="form-body">
                                                                                                <h4 class="form-section">
                                                                                                    <i
                                                                                                        class="ft-user"></i>
                                                                                                    عملية إيداع
                                                                                                </h4>
                                                                                                <div
                                                                                                    class="row">

                                                                                                    <div
                                                                                                        class="col-md-6">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label
                                                                                                                for="projectinput3">إختر
                                                                                                                الخزنة</label>
                                                                                                            <select
                                                                                                                class="select2-rtl form-control"
                                                                                                                data-placeholder="إختر الخزنة..."
                                                                                                                name="safe_id"
                                                                                                                required>
                                                                                                                <option>
                                                                                                                </option>
                                                                                                                @foreach ($safes as $safe)
                                                                                                                    <option
                                                                                                                        value="{{ $safe->id }}">
                                                                                                                        {{ $safe->safe_name }}
                                                                                                                    </option>
                                                                                                                @endforeach


                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="col-md-6">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label
                                                                                                                for="timesheetinput2">المبلغ</label>
                                                                                                            <div
                                                                                                                class="position-relative has-icon-left">
                                                                                                                <input
                                                                                                                    type="number"
                                                                                                                    id="timesheetinput2"
                                                                                                                    class="form-control"
                                                                                                                    name="amount"
                                                                                                                    value="{{ $item->amount }}"
                                                                                                                    required
                                                                                                                    readonly>
                                                                                                                <div
                                                                                                                    class="form-control-position">
                                                                                                                    <i
                                                                                                                        class="la la-money"></i>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <div
                                                                                                    class="form-group">
                                                                                                    <label
                                                                                                        for="projectinput8">تفاصيل
                                                                                                        الإيداع</label>
                                                                                                    <div
                                                                                                        class="position-relative has-icon-left">
                                                                                                        <textarea
                                                                                                            id="projectinput8"
                                                                                                            rows="3"
                                                                                                            class="form-control"
                                                                                                            name="notes"
                                                                                                            readonly>قسط على فاتورة رقم {{ $item->id }}</textarea>
                                                                                                        <div
                                                                                                            class="form-control-position">
                                                                                                            <i
                                                                                                                class="la la-sticky-note"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <button type="button"
                                                                                                    class="btn grey btn-outline-secondary"
                                                                                                    data-dismiss="modal"><i
                                                                                                        class="ft-x"></i>
                                                                                                    الغاء</button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-outline-primary"><i
                                                                                                        class="la la-check-square-o"></i>
                                                                                                    تسجيل</button>
                                                                                        </form>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="linkOpt2" role="tabpanel"
                                            aria-labelledby="linkOpt-tab2" aria-expanded="false">
                                            <div class="table-responsive">
                                                <table class="table mb-0" id="most-ordered">
                                                    <thead>
                                                        <tr>
                                                            <th>اسم الصنف</th>
                                                            <th>إجمالي الكمية التي اشتراها العميل</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($mostOrdered as $item)
                                                            <tr>
                                                                <td>{{ $item->product->product_name }}</td>
                                                                <td>{{ $item->count }} مرة</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @if ($customer->customer_type == 'company')
                                            <div class="tab-pane" id="linkOpt2xx" role="tabpanel"
                                                aria-labelledby="linkOpt-tab2" aria-expanded="false">
                                                <button type="button" class="btn btn-outline-primary block btn-lg"
                                                    data-toggle="modal" data-target="#default">
                                                    إضافة موظف / ممثل للشركة
                                                </button>
                                                <br>
                                                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel1">بيانات الموظف
                                                                </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('customers.addLinked', $customer->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"
                                                                            name="linked_name" placeholder="إسم الموظف">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"
                                                                            name="linked_title"
                                                                            placeholder="المسمى الوظيفي">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input class="form-control" type="text"
                                                                            name="linked_mobile" placeholder="رقم التليفون">
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn grey btn-outline-secondary"
                                                                    data-dismiss="modal">إلغاء</button>
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary">حفظ</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table mb-0" id="linked">
                                                        <thead>
                                                            <tr>
                                                                <th>اسم الموظف / القسم </th>
                                                                <th>المسمى الوظيفي</th>
                                                                <th>رقم التليفون</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $customer->customer_name }}</td>
                                                                <td>{{ $customer->customer_title }}</td>
                                                                <td>{{ $customer->customer_mobile }}</td>
                                                            </tr>
                                                            @foreach ($linkedCustomers as $link)
                                                                <tr>
                                                                    <td>{{ $link->customer_name }}</td>
                                                                    <td>{{ $link->customer_title }}</td>
                                                                    <td>{{ $link->customer_mobile }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-content">
        <div class="card-body">

          <div class="col-12">
             <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> فاتورة جديدة</a>
              <h2 style="text-align: center">الفواتير</h2>

          </div>
        </div>
      </div>
    </div>
    </div>
  <div class="col-md-6">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <div class="col-12">
            <a href="#" class="btn btn-social mb-1 mr-1 btn-sm btn-success" style="float: left"><span class="la la-plus"></span> عرض سعر جديد</a>
            <h2 style="text-align: center">عروض الأسعار</h2>

        </div>
      </div>
    </div>
  </div>
  </div>
</div> --}}
                {{-- <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-content">
          <div class="card-body">

            <div class="col-12">
                <h2 style="text-align: center">المبالغ المستحقة</h2>

            </div>
          </div>
        </div>
      </div>
      </div>
    <div class="col-md-6">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="col-12">
              <h2 style="text-align: center">الأصناف الأكثر طلبا</h2>

          </div>
        </div>
      </div>
    </div>
    </div>
  </div> --}}

                <!-- users view card details ends -->

            </section>
            <!-- users view ends -->
        </div>
    </div>



    @include('common.footer')
@endsection


@section('pageJs')
    <!-- BEGIN: Page Vendor JS-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- END: Page Vendor JS-->
    <script>
        $("#linked").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'قائمة ممثلين / موظفين الشركة',
                    exportOptions: {
                        columns: [2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    // customize: function(doc) {
                    //    console.dir(doc)
                    //    doc.content[2].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
                    //    doc.content[2].margin = [ 0, 0, 0, 0 ] //left, top, right, bottom
                    // },
                    text: 'حفظ كملف PDF',
                    messageTop: 'قائمة ممثلين / موظفين الشركة',
                    exportOptions: {
                        columns: [2, 1, 0],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'قائمة ممثلين / موظفين الشركة',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ]
        });

        $("#pos").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'فواتير البيع السريع للعميل {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    // customize: function(doc) {
                    //    console.dir(doc)
                    //    doc.content[2].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
                    //    doc.content[2].margin = [ 0, 0, 0, 0 ] //left, top, right, bottom
                    // },
                    text: 'حفظ كملف PDF',
                    messageTop: 'فواتير البيع السريع للعميل \n {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [2, 1, 0],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'فواتير البيع السريع للعميل {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ]
        });
        $("#reciepts").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'فواتير العميل {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    // customize: function(doc) {
                    //    console.dir(doc)
                    //    doc.content[2].margin = [ 100, 0, 100, 0 ] //left, top, right, bottom
                    //    doc.content[2].margin = [ 0, 0, 0, 0 ] //left, top, right, bottom
                    // },
                    text: 'حفظ كملف PDF',
                    messageTop: 'فواتير العميل \n {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [2, 1, 0],
                    },

                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'فواتير العميل {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ]
        });
        $("#quotations").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'عروض أسعار {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'عروض أسعار \n {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'عروض أسعار {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ]
        });
        $("#due").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'المبالغ المستحقة على {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'المبالغ المستحقة على \n {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [3, 2, 1, 0]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'المبالغ المستحقة على {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                }
            ]
        });
        $("#most-ordered").DataTable({
            dom: 'Bfrtip',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'حفظ كملف EXCEL',
                    messageTop: 'الأصناف الأكثر طلبا ل {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [1, 0]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'حفظ كملف PDF',
                    messageTop: 'الأصناف الأكثر طلبا ل \n {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [1, 0]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    messageTop: 'الأصناف الأكثر طلبا ل {{ $customer->customer_name }}',
                    exportOptions: {
                        columns: [0, 1]
                    }
                }
            ]
        });
    </script>

    <script>

        $("#invoiceNav").on('click',function(){
            $('.nav-link').removeClass('active');
            $("#active-tab32").addClass('active');
            
            if($("#active-tab32").hasClass('active')){
                
                // $('#active-tab32').trigger('click');
                // $('#active-tab32').click();?
                // $("#active32").siblings().css('display','none');
                // $("#active32").css('display','block');

            } else{
                
            }
        });
        
        // document.getElementById("invoiceNav").onclick = evt => {

        //     simulateClick()
        // }

        // function simulateClick() {

        //     var evt = new MouseEvent("click");

        //     var cb = document.getElementById("#active-tab32");
        //     var canceled = !cb.dispatchEvent(evt);

        //     if (canceled) {
        //         return canceled;
        //     } else {
        //         // None of the handlers called preventDefault
        //         return cb.dispatchEvent(evt);
        //     }
        // }

        
    </script>



    <!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script> --}}
    <!-- END: Page JS-->
@endsection
