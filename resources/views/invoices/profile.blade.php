@extends('layouts.erp')
@section('title', 'إستعراض فاتورة رقم #' . $invoice->id)

@section('pageCss')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/invoices.min2.css') }}"
        id="printCss">
    <!-- END: Page CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/toggle/switchery.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/switch.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-switch.min.css') }}"> --}}


@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">فواتير المبيعات</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('invoices.list') }}">فواتير المبيعات</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <section class="card">
                <div id="invoice-template" class="card-body p-4">
                    <!-- Invoice Company Details -->
                    <div id="invoice-company-details" class="row">
                        <div class="col-sm-6 col-12 text-center text-sm-left">
                            <div class="media row">
                                <div class="col-12 col-sm-12 col-xl-10">
                                    <div class="media-body">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">{{ $company }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="media row">
                                <div class="col-12">
                                    <img src="{{ asset($logo) }}" alt="{{ $company }}" class="mb-1 mb-sm-0"
                                        style="width: 200px;height:80px;" />
                                </div>
                                <div class="col-12">
                                    <div class="media-body">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li>{{ $address_1 }}</li>
                                            <li>{{ $address_2 }}</li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center text-sm-right">
                            <h2>فاتورة مبيعات</h2>
                            <p class="pb-sm-3">رقم {{ $invoice->id }}
                                @if ($invoice->was_price_quotation)
                                    <br />
                                    <i><u>(محولة من عرض سعر رقم {{ $invoice->price_quotation_id }})</u></i>
                                @endif
                                @if ($invoice->was_price_quotation)
                                    <br />
                                    <i><u>رقم الفاتورة الورقية: {{ $invoice->invoice_paper_num }}</u></i>
                                @endif

                            </p>
                            <ul class="px-0 list-unstyled">
                                <li>إجمالي الفاتورة</li>
                                <li class="lead text-bold-800">{{ $invoice->invoice_total }} ج.م</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Invoice Company Details -->

                    <!-- Invoice Customer Details -->
                    <div id="invoice-customer-details" class="row pt-2">
                        <div class="col-12 text-center text-sm-left">
                            <p class="text-muted">بيانات الجهه</p>
                        </div>
                        <div class="col-sm-6 col-12 text-center text-sm-left">
                            <ul class="px-0 list-unstyled">
                                <li class="text-bold-800">
                                    {{$invoice->customer->customer_name}}
                        @if($invoice->customer->customer_title)
                        <br>
                        [{{$invoice->customer->customer_title}}]
                        @endif
                        @if($invoice->customer->customer_company)
                        <br>
                        {{$invoice->customer->customer_company}}
                        @endif
                        @if($invoice->customer->parent)
                        <br> {{$invoice->customer->parent->customer_company}}
                        @endif
                                </li>
                                <li>موبايل: {{ $invoice->customer->customer_mobile }}</li>
                                <li>
                                    @if (isset($invoice->customer->customer_phone))
                                        هاتف: {{ $invoice->customer->customer_phone }}

                                    @endif
                                </li>
                                <li>
                                    @if (isset($invoice->customer->customer_address))
                                        العنوان: {{ $invoice->customer->customer_address }}

                                    @endif
                                </li>

                            </ul>
                        </div>
                        <div class="col-sm-6 col-12 text-center text-sm-right">
                            <p><span class="text-muted">تاريخ الفاتورة: </span> {{ $invoice->invoice_date }}</p>
                            @if($invoice->invoice_paper_num)
                                <p><span class="text-muted">رقم الفاتورة الورقية: </span> {{ $invoice->invoice_paper_num }}</p>
                            @endif
                            <p><span class="text-muted">الدفع:</span>
                                @if ($invoice->already_paid)
                                    تم الدفع
                                @else
                                    لم يتم الدفع
                                @endif
                            </p>

                        </div>
                    </div>
                    <!-- Invoice Customer Details -->

                    <!-- Invoice Items Details -->
                    <div id="invoice-items-details" class="pt-2">
                        <div class="row">
                            <div class="table-responsive col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>البند و الوصف</th>
                                            <th class="text-right">سعر الوحدة </th>
                                            <th class="text-right">الكمية</th>
                                            <th class="text-right">المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <span style="display: none">{{ $subtotal = 0 }}</span>
                                        @foreach ($invoice->productsInInvoice as $key => $product)

                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    <p>{{ $product->product->product_name }}</p>
                                                    <p class="small">
                                                        <em>{{ $product->product->product_desc }}</em>
                                                    </p>
                                                </td>
                                                <td class="text-right">{{ $product->product_price }} ج.م</td>
                                                <td class="text-right">{{ $product->product_qty }}</td>
                                                <td class="text-right">
                                                    {{ $product->product_price * $product->product_qty }} ج.م</td>
                                            </tr>
                                            <span
                                                style="display: none">{{ $subtotal += $product->product_price * $product->product_qty }}</span>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7 col-12 text-center text-sm-left">
                                <p class="lead">الدفع:</p>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>طريقة الدفع</strong></td>
                                                        <td class="text-right">
                                                            @if ($invoice->payment_method == 'cash')
                                                                <span>كاش</span>
                                                            @elseif($invoice->payment_method == 'visa')
                                                                <span>فيزا</span>
                                                            @elseif($invoice->payment_method == 'later')
                                                                <span>أجل</span>
                                                            @elseif($invoice->payment_method == 'bankTransfer')
                                                                <span>تحويل بنكي</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if ($invoice->already_paid)
                                                        @if ($invoice->payment_method != 'later')
                                                            <tr>
                                                                <td><strong>رقم ايصال الدفع:</strong></td>
                                                                <td class="text-right">
                                                                    {{ $invoice->safe_transaction_id }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>الخزنة التي تم الإيداع بها:</strong></td>
                                                                <td class="text-right">{{ $invoice->safe->safe_name }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($invoice->payment_method == 'later')
                                            <div class="table-responsive" style="    overflow: hidden;">
                                                <table class="table table-border table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>المبلغ</th>
                                                            <th>تاريخ الإستحقاق</th>
                                                            <th>تم دفعها؟</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($invoice->datesInInvoice as $key2 => $item)
                                                            <tr>
                                                                <th scope="row">
                                                                    {{ $item->amount }}
                                                                </th>
                                                                <td>
                                                                    {{ $item->date }}
                                                                    {{ $item->notes }}
                                                                </td>

                                                                <td>
                                                                    @if ($item->paid != 'No')
                                                                        <span class="text-success"> تم الدفع</span>
                                                                    @else
                                                                        <span class="text-danger"> لم يتم الدفع</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-5 col-12">
                                <p class="lead">الحساب</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>المجموع</td>
                                                <td class="text-right">
                                                    {{ $subtotal }} ج.م
                                                </td>
                                            </tr>
                                            @if ($invoice->discount_percentage > 0)
                                                <tr>
                                                    <td>الخصم (النسبة)</td>
                                                    <td class="text-right">
                                                        [{{ $invoice->discount_percentage }} %]
                                                        @if (preg_match('/^\d+\.\d+$/', ($invoice->discount_percentage / 100) * $subtotal)) * @endif
                                                        {{ round(($invoice->discount_percentage / 100) * $subtotal) }} ج.م
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($invoice->discount_amount > 0)
                                                <tr>
                                                    <td>الخصم (المبلغ)</td>
                                                    <td class="text-right">{{ $invoice->discount_amount }} ج.م</td>
                                                </tr>
                                            @endif
                                            @if ($invoice->invoice_tax > 0)
                                                <tr>
                                                    <td>الضريبة</td>
                                                    <td class="text-right">
                                                        [{{ $invoice->invoice_tax }} %]
                                                        <span style="display: none"></span>
                                                        @if (preg_match('/^\d+\.\d+$/', ($invoice->invoice_tax / 100) * $subtotal)) * @endif
                                                        {{ round(($invoice->invoice_tax / 100) * $subtotal) }} ج.م
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($invoice->shipping_fees > 0)
                                                <tr>
                                                    <td>الشحن</td>
                                                    <td class="text-right">{{ $invoice->shipping_fees }} ج.م</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="text-bold-800">الإجمالي</td>
                                                <td class="text-bold-800 text-right"> {{ $invoice->invoice_total }} ج.م
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset('theme/app-assets/images/pages/signature-scan.png')}}" alt="signature" class="height-100" />
                      <h6>إسم الشخص</h6>
                      <p class="text-muted">مدير المشتريات</p>
                    </div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Footer -->
                    <div id="invoice-footer">
                        <div class="row">
                            <div class="col-sm-7 col-12 text-center text-sm-left">
                                <h6>الشروط / الملاحظات</h6>
                                {!! $invoice->invoice_note !!}
                            </div>
                            <div class="col-sm-5 col-12 text-center">
                                {{-- <div class="modal fade text-left" id="printingOptions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel1">إختيارات الطباعة</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">رجوع</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                                {{-- <button type="button" class="btn btn-info btn-print-modal btn-lg my-1" data-toggle="modal" data-target="#printingOptions"><i class="la la-paper-plane-o mr-50"></i>
                      طباعة الفاتورة</button> --}}

                                <button class="btn btn-block btn-success btn-print" id="print1">طباعة على ورق أبيض</button>
                                <div class="hidePrint"> أو</div>
                                <a target="_blank" href="{{ route('invoices.print2', $invoice->id) }}"
                                    class="btn btn-block btn-info btn-print">طباعة على ورق ليتر هيد</a>
                                <div class="hidePrint"> أو</div>
                                <form action="{{ route('invoices.print3', $invoice->id) }}" method="POST" target="_blank"
                                    class="hidePrint">
                                    @csrf
                                    <div class="form-group">
                                        @env('local', 'development')
                                        <select class="form-control" name="template">
                                            <option value="1">التصميم رقم #1</option>
                                            <option value="2">التصميم رقم #2</option>
                                            <option value="3">التصميم رقم #3</option>
                                            <option value="4">التصميم رقم #4</option>
                                        </select>
                                        @endenv
                                        @env('production')
                                        @if (request()->getHttpHost() == 'e1.mygesture.co')
                                            <select class="form-control" name="template">
                                                <option value="3">التصميم رقم #1</option>
                                            </select>
                                        @elseif(request()->getHttpHost() == 'e2.mygesture.co')
                                            <select class="form-control" name="template">
                                                <option value="1">التصميم رقم #1</option>
                                                <option value="2">التصميم رقم #2</option>
                                            </select>
                                        @elseif(request()->getHttpHost() == 'e3.mygesture.co')
                                            <select class="form-control" name="template">
                                                <option value="4">التصميم رقم #1</option>
                                            </select>
                                        @endif
                                        @endenv
                                        <button type="submit" class="btn btn-block btn-dark btn-print">طباعة
                                            بالتصميم</button>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Invoice Footer -->

                </div>
            </section>

        </div>
    </div>

    @include('common.footer')
@endsection

@section('pageJs')

    {{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js') }}"></script> --}}

    <!-- BEGIN: Theme JS-->



    <script src="{{ asset('theme/app-assets/js/scripts/pages/invoice-template.min.js') }}"></script>
    <!-- END: Theme JS-->

    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/editors/editor-ckeditor.min.js') }}"></script> --}}
    <script>


    </script>

@endsection
