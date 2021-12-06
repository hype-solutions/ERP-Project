@extends('layouts.erp')
@section('title', 'التحكم')
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
    <!-- END: Page CSS-->
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- users view start -->
            <section id="card-gradient-options">

                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="row">
                            @can('View POS')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('pos.landing') }}">
                                                    <h4>البيع السريع</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/pos.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View PQ')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('invoicespricequotations.list') }}">
                                                    <h4>عروض الأسعار</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/pq.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Invoices')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('invoices.list') }}">
                                                    <h4>فواتير المبيعات</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/invoice.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Projects')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-yellow">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('projects.list') }}">
                                                    <h4>إدارة المشاريع</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/projects.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <div class="row">
                            @can('View Branches')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('branches.list') }}">
                                                    <h4 class="text-white">الفروع</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/branchesList.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Safes')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('safes.list') }}">
                                                    <h4 class="text-white">الخزن</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/safe.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Customers')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('customers.list') }}">
                                                    <h4 class="text-white">العملاء</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/customersList.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Suppliers')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-warning">
                                        <div class="card-body text-center">
                                            <a href="{{ route('suppliers.list') }}">
                                                <h4 class="text-white">الموردين</h4>
                                                <img style="width:65%"
                                                    src="{{ asset('theme/app-assets/images/custom/suppliersList.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <div class="row">
                            @can('View Products')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-info">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('products.list') }}">
                                                    <h4 class="text-white">المخزن</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/productsList.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Income')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-success">
                                        <div class="card-body text-center">
                                            <a href="{{ route('ins.list') }}">
                                                <h4 class="text-white">الدواخل</h4>
                                                <img style="width:65%"
                                                    src="{{ asset('theme/app-assets/images/custom/income.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Expenses')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-danger">
                                        <div class="card-body text-center">
                                            <a href="{{ route('outs.list') }}">
                                                <h4 class="text-white">المصاريف</h4>
                                                <img style="width:65%"
                                                    src="{{ asset('theme/app-assets/images/custom/expenses.png') }}" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View PO')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-danger">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('purchasesorders.list') }}">
                                                    <h4 class="text-white">أوامر الشراء</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/purchase-order.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <div class="row">
                            @can('View Users')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-grey-blue">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('users.list') }}">
                                                    <h4 class="text-white">المستخدمين</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/users.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Roles')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-purple">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('settings.roles') }}">
                                                    <h4 class="text-white">الصلاحيات</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/roles.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View General Settings')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-secondary">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('settings.list') }}">
                                                    <h4 class="text-white">الإعدادات</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/settings.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('View Reports')
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <div class="card text-white box-shadow-0 bg-gradient-x-pink">
                                        <div class="card-content collapse show">
                                            <div class="card-body text-center">
                                                <a href="{{ route('reports.landing') }}">
                                                    <h4 class="text-white">التقارير</h4>
                                                    <img style="width:65%"
                                                        src="{{ asset('theme/app-assets/images/custom/reports.png') }}" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">التحكم السريع</h3>
                            </div>
                            <div class="card-body">
                                @canany(['Accept PQ', 'Convert PQ'])
                                    <span class="btn btn-block btn-outline-dark">عروض الأسعار (<span
                                            class="text-danger">{{ $priceQuotationsCount }}</span>)</span>
                                    <div id="priceQuotations" role="tablist" aria-multiselectable="true">
                                        <div class="card accordion collapse-icon accordion-icon-rotate">
                                            @if ($priceQuotationsCount == 0)
                                                <span class="text-success">لا يوجد جديد</span>
                                            @endif
                                            @foreach ($priceQuotations as $key => $quotation)
                                                <a id="headinga{{ $key }}" class="card-header info collapsed"
                                                    data-toggle="collapse" href="#accordiona{{ $key }}"
                                                    aria-expanded="false" aria-controls="accordiona{{ $key }}">
                                                    <div class="card-title lead">عرض سعر رقم #{{ $quotation->id }}</div>
                                                </a>
                                                <div id="accordiona{{ $key }}" role="tabpanel"
                                                    data-parent="#priceQuotations"
                                                    aria-labelledby="headinga{{ $key }}" class="collapse"
                                                    style="">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>العميل</th>
                                                                        <td>{{ $quotation->customer->customer_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الإجمالي</th>
                                                                        <td>{{ $quotation->quotation_total }} ج.م</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a href="{{ route('invoicespricequotations.view', $quotation->id) }}"
                                                                class="btn btn-info btn-sm"><i class="la la-folder-open"></i>
                                                                استعراض</a>
                                                            @if ($quotation->quotation_status == 'Pending Approval')
                                                                @can('Accept PQ')
                                                                    <a class="btn btn-success btn-sm"
                                                                        href="{{ route('invoicespricequotations.status', [$quotation->id, 1]) }}"><i
                                                                            class="la la-check"></i> تصديق</a>
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="{{ route('invoicespricequotations.status', [$quotation->id, 2]) }}"><i
                                                                            class="la la-close"></i> رفض</a>
                                                                @endcan
                                                            @elseif($quotation->quotation_status == 'Approved')
                                                                @can('Convert PQ')
                                                                    <a href="{{ route('invoicespricequotations.toinvoice', $quotation->id) }}"
                                                                        class="btn btn-dark btn-sm"><i class="la la-file"></i>
                                                                        تحويل الى فاتورة</a>
                                                                @endcan
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($priceQuotationsCount > 5)
                                                <a href="{{ route('invoicespricequotations.list') }}"
                                                    class="text-center btn btn-success btn-sm round">عرض المزيد</a>
                                            @endif
                                        </div>
                                    </div>
                                @endcanany
                                @canany(['Accept PO', 'Import PO'])
                                    <span class="btn btn-block btn-outline-dark">أوامر الشراء (<span
                                            class="text-danger">{{ $purchasesOrdersCount }}</span>)</span>
                                    <div id="purchasesOrders" role="tablist" aria-multiselectable="true">
                                        <div class="card accordion collapse-icon accordion-icon-rotate">
                                            @if ($purchasesOrdersCount == 0)
                                                <span class="text-success">لا يوجد جديد</span>
                                            @endif
                                            @foreach ($purchasesOrders as $key => $purchase)
                                                <a id="headingb{{ $key }}" class="card-header info collapsed"
                                                    data-toggle="collapse" href="#accordionb{{ $key }}"
                                                    aria-expanded="false" aria-controls="accordionb{{ $key }}">
                                                    <div class="card-title lead">أمر شراء رقم #{{ $purchase->id }}</div>
                                                </a>
                                                <div id="accordionb{{ $key }}" role="tabpanel"
                                                    data-parent="#purchasesOrders"
                                                    aria-labelledby="headingb{{ $key }}" class="collapse"
                                                    style="">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>المورد</th>
                                                                        <td>{{ $purchase->supplier->supplier_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الإجمالي</th>
                                                                        <td>{{ $purchase->purchase_total }} ج.م</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a href="{{ route('purchasesorders.view', $purchase->id) }}"
                                                                class="btn btn-info btn-sm"><i class="la la-folder-open"></i>
                                                                استعراض</a>
                                                            @if ($purchase->purchase_status == 'Created')
                                                                @can('Accept PQ')
                                                                    <a class="btn btn-success btn-sm"
                                                                        href="{{ route('purchasesorders.status', [$purchase->id, 1]) }}"><i
                                                                            class="la la-check"></i> تصديق</a>
                                                                    <a class="btn btn-danger btn-sm"
                                                                        href="{{ route('purchasesorders.status', [$purchase->id, 2]) }}"><i
                                                                            class="la la-close"></i> رفض</a>
                                                                @endcan
                                                            @elseif($purchase->purchase_status =='Paid')
                                                                @can('Import PO')
                                                                    <a href="{{ route('purchasesorders.toinventory', $purchase->id) }}"
                                                                        class="btn btn-dark btn-sm"><i class="la la-file"></i>
                                                                        توريد الى المخزن</a>
                                                                @endcan
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($purchasesOrdersCount > 5)
                                                <a href="{{ route('purchasesorders.list') }}"
                                                    class="text-center btn btn-outline-warning btn-sm round">كل العروض</a>
                                            @endif
                                        </div>
                                    </div>
                                @endcanany
                                @canany(['Accept Products Transfer', 'Decline Products Transfer'])
                                    <span class="btn btn-block btn-outline-dark">المخزن (<span
                                            class="text-danger">{{ $productTransfersCount }}</span>)</span>
                                    <div id="productTransfers" role="tablist" aria-multiselectable="true">
                                        <div class="card accordion collapse-icon accordion-icon-rotate">
                                            @if ($productTransfersCount == 0)
                                                <span class="text-success">لا يوجد جديد</span>
                                            @endif
                                            @foreach ($productTransfers as $key => $transfer)
                                                <a id="headingd{{ $key }}" class="card-header info collapsed"
                                                    data-toggle="collapse" href="#accordiond{{ $key }}"
                                                    aria-expanded="false" aria-controls="accordiond{{ $key }}">
                                                    <div class="card-title lead">عملية تحويل رقم #{{ $transfer->id }}</div>
                                                </a>
                                                <div id="accordiond{{ $key }}" role="tabpanel"
                                                    data-parent="#productTransfers"
                                                    aria-labelledby="headingd{{ $key }}" class="collapse"
                                                    style="">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>المنتج</th>
                                                                        <td>{{ $transfer->product->product_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>من</th>
                                                                        <td>{{ $transfer->branchFrom->branch_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الى</th>
                                                                        <td>{{ $transfer->branchTo->branch_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الكمية</th>
                                                                        <td>{{ $transfer->transfer_qty }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>قام بالتحويل</th>
                                                                        <td>
                                                                            <div
                                                                                class="badge border-primary primary badge-border">
                                                                                <i class="la la-user font-medium-2"></i>
                                                                                <span>{{ $transfer->transferUser->username }}</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a href="" class="btn btn-info btn-sm"><i
                                                                    class="la la-folder-open"></i> استعراض</a>
                                                            @if ($transfer->branchFrom->getProductAmountInBranch($transfer->product_id)->amount >= $transfer->transfer_qty)
                                                                <a href="{{ route('products.acceptingTransfer', $transfer->id) }}"
                                                                    class="btn btn-success btn-sm">تصديق على التحويل</a>
                                                            @else
                                                                <button class="btn btn-success btn-sm " disabled>لا توجد كمية
                                                                    تكفي للتحويل</button>
                                                            @endif
                                                            <a href="{{ route('products.rejectingTransfer', $transfer->id) }}"
                                                                class="btn btn-danger btn-sm">رفض</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($productTransfersCount > 5)
                                                <a href="{{ route('products.transfers') }}"
                                                    class="text-center btn btn-success btn-sm round">عرض المزيد</a>
                                            @endif
                                        </div>
                                    </div>
                                @endcanany
                                @canany(['Accept Safes Transfers', 'Accept Safes Deposit', 'Accept Safes Withdraw'])
                                    {{-- add to can any [auth out, auth in] --}}
                                    <span class="btn btn-block btn-outline-dark">الخزن (<span
                                            class="text-danger">{{ $safesTransfersCount + $outsCount + $insCount }}</span>)</span>
                                    <div id="safesTransfers" role="tablist" aria-multiselectable="true">
                                        <div class="card accordion collapse-icon accordion-icon-rotate">
                                            @if ($safesTransfersCount + $outsCount + $insCount == 0)
                                                <span class="text-success">لا يوجد جديد</span>
                                            @endif
                                            @foreach ($safesTransfers as $key => $transfer)


                                                <a id="headingc{{ $key }}" class="card-header info collapsed"
                                                    data-toggle="collapse" href="#accordionc{{ $key }}"
                                                    aria-expanded="false" aria-controls="accordionc{{ $key }}">
                                                    <div class="card-title lead">عملية تحويل رقم
                                                        #{{ $transfer->id }}
                                                    </div>
                                                </a>
                                                <div id="accordionc{{ $key }}" role="tabpanel"
                                                    data-parent="#safesTransfers" aria-labelledby="headingc{{ $key }}"
                                                    class="collapse" style="">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>من</th>
                                                                        <td>{{ $transfer->safeFrom->safe_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الى</th>
                                                                        <td>{{ $transfer->safeTo->safe_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>المبلغ</th>
                                                                        <td>{{ $transfer->transfer_amount }} ج.م</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>قام بالتحويل</th>
                                                                        <td>
                                                                            <div
                                                                                class="badge border-primary primary badge-border">
                                                                                <i class="la la-user font-medium-2"></i>
                                                                                <span>{{ $transfer->transferUser->username }}</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <a class="btn btn-success btn-sm"
                                                                href="{{ route('safes.accepting', $transfer->id) }}"><i
                                                                    class="la la-check"></i> تصديق</a>
                                                            <a class="btn btn-danger btn-sm" href="#"><i
                                                                    class="la la-close"></i> رفض</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                            @foreach ($outs as $key => $out)
                                                <a id="headingc{{ $key }}" class="card-header info collapsed"
                                                    data-toggle="collapse" href="#accordionc{{ $key }}"
                                                    aria-expanded="false" aria-controls="accordionc{{ $key }}">
                                                    <div class="card-title lead">سحب مصاريف
                                                        #{{ $out->id }}
                                                    </div>
                                                </a>
                                                <div id="accordionc{{ $key }}" role="tabpanel"
                                                    data-parent="#safesTransfers" aria-labelledby="headingc{{ $key }}"
                                                    class="collapse" style="">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>الخزنة</th>
                                                                        <td>{{ $out->safe->safe_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الملاحظات</th>
                                                                        <td>{{ $out->notes }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>المبلغ</th>
                                                                        <td>{{ $out->amount }} ج.م</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>قام بالطلب</th>
                                                                        <td>
                                                                            <div
                                                                                class="badge border-primary primary badge-border">
                                                                                <i class="la la-user font-medium-2"></i>
                                                                                <span>{{ $out->done_user->username }}</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <form action="{{ route('outs.authorizeOut', [$out->id, 1]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                                        class="la la-check"></i>تصديق</button>
                                                            </form>
                                                            <form action="{{ route('outs.authorizeOut', [$out->id, 2]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button class="btn btn-danger btn-sm" type="submit"><i
                                                                        class="la la-close"></i> رفض</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                            @foreach ($ins as $key => $in)
                                                <a id="headingc{{ $key }}" class="card-header info collapsed"
                                                    data-toggle="collapse" href="#accordionc{{ $key }}"
                                                    aria-expanded="false" aria-controls="accordionc{{ $key }}">
                                                    <div class="card-title lead"> إضافة دواخل
                                                        #{{ $in->id }}
                                                    </div>
                                                </a>
                                                <div id="accordionc{{ $key }}" role="tabpanel"
                                                    data-parent="#safesTransfers"
                                                    aria-labelledby="headingc{{ $key }}" class="collapse"
                                                    style="">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>الخزنة</th>
                                                                        <td>{{ $in->safe->safe_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>الملاحظات</th>
                                                                        <td>{{ $in->notes }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>المبلغ</th>
                                                                        <td>{{ $in->amount }} ج.م</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>قام بالطلب</th>
                                                                        <td>
                                                                            <div
                                                                                class="badge border-primary primary badge-border">
                                                                                <i class="la la-user font-medium-2"></i>
                                                                                <span>{{ $in->done_user->username }}</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <form action="{{ route('ins.authorizeIn', [$in->id,1]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                                        class="la la-check"></i>تصديق</button>
                                                            </form>
                                                            <form action="{{ route('ins.authorizeIn', [$in->id,2]) }}"
                                                                method="POST">
                                                                @csrf
                                                            <button class="btn btn-danger btn-sm" type="submit"><i
                                                                    class="la la-close"></i> رفض</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>
                                    </div>
                                @endcanany

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('common.footer')
@endsection
