<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>عرض سعر رقم {{ $invoice->id }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/vendors-rtl.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style-rtl.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/invoices.min3.css') }}" id="printCss"> --}}

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            direction: rtl;
            /* background-color: #FAFAFA; */
            /* font: 12pt "Tahoma"; */
        }

        .notFirst {
            @if ($template == 3)padding-top: 8cm;
        @else padding-top: 3cm;
            @endif
        }

        .notFirst2 {
            padding-top: 2cm;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            /* Chrome, Safari */
            color-adjust: exact !important;
            /*Firefox*/
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding-top: 20mm;
            padding-right: 10mm;
            padding-bottom: 94mm;
            padding-left: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;

            @if ($template == 1)background-image: url(https://e1.mygesture.co/uploads/letterHead1.jpg) !important;
        @elseif($template==2) background-image: url(https://e1.mygesture.co/uploads/letterHead2.jpg) !important;
        @elseif($template==3) background-image: url(https://e1.mygesture.co/uploads/letterHead3.jpg) !important;
        @elseif($template==4) background-image: url(https://e1.mygesture.co/uploads/letterHead4.jpg) !important;
            @endif-webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            /* background-attachment: fixed; */
            background-position: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            /* padding: 1cm; */
            /* border: 5px red solid; */
            height: 257mm;
            /* outline: 2cm #FFEAEA solid; */
        }

        @page {
            size: a4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
                -webkit-background-size: 100% 100%;
                -moz-background-size: 100% 100%;
                -o-background-size: 100% 100%;
                background-size: 100% 100%;
                background-repeat: no-repeat;
            }


            .page:last-child {
                page-break-after: auto;
                padding-bottom: 85mm;
            }

            #invoice-footer {
                position: relative;
                /* top: -20px !important */
            }

            .table-responsive {
                -ms-overflow-style: none
            }


            #invoice-template,
            .content-wrapper {
                padding-top: 0
            }
        }

    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage ">
                <div class="app-content content">
                    <div class="content-overlay"></div>
                    <div class="content-wrapper">

                        <div class="content-body">
                            <section class="">
                                {{-- <div id="invoice-template" class="card-body p-4" style="min-height:1320px;"> --}}
                                <div id="invoice-template" class="   ">
                                    <!-- Invoice Company Details -->
                                    <div id="invoice-customer-details" class="row pt-2" style="">

                                        <div class="col-sm-6 col-12 text-center text-sm-left notFirst2"
                                            @if ($template == 3) style="margin-top:150px;" @endif>
                                            <p class="text-muted">بيانات الجهة</p>
                                            <ul class="px-0 list-unstyled">
                                                <li class="text-bold-800">
                                                    {{ $invoice->customer->customer_name }}
                                                    @if ($invoice->customer->customer_title)
                                                        <br>
                                                        {{ $invoice->customer->customer_title }}
                                                    @endif
                                                    @if ($invoice->customer->customer_company)
                                                        <br>
                                                        {{ $invoice->customer->customer_company }}
                                                    @endif
                                                    @if ($invoice->customer->parent)
                                                        <br> {{ $invoice->customer->parent->customer_company }}
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
                                        @if ($template != 3)
                                            <div class="col-sm-6 col-12 text-center text-sm-right"
                                                @if ($template == 4) style="    margin-top: 85px;" @else style="    margin-top: 65px;" @endif>
                                                <h2>عرض سعر</h2>
                                                <p class="pb-sm-3">رقم {{ $invoice->id }}</p>
                                                <ul class="px-0 list-unstyled">
                                                    <li>إجمالي عرض السعر</li>
                                                    <li class="lead text-bold-800">{{ $invoice->quotation_total }}
                                                        ج.م
                                                    </li>
                                                </ul>
                                                <p><small class="text-muted">تاريخ عرض السعر:
                                                    {{ $invoice->quotation_date }} <br>
                                                صالح لمده:
                                                    {{ $invoice->days_valid }} يوم</small></p>
                                            </div>
                                        @else
                                            <div class="col-sm-2 col-12 text-center text-sm-right">
                                                <h2>عرض سعر</h2>
                                                <p class="pb-sm-3">رقم {{ $invoice->id }}</p>
                                                <ul class="px-0 list-unstyled">
                                                    <li>إجمالي عرض السعر</li>
                                                    <li class="lead text-bold-800">{{ $invoice->quotation_total }}
                                                        ج.م
                                                    </li>
                                                </ul>
                                                <p><span class="text-muted">تاريخ عرض السعر: </span>
                                                    {{ $invoice->quotation_date }}</p>
                                                <p><span class="text-muted">صالح لمده: </span>
                                                    {{ $invoice->days_valid }} يوم</p>
                                            </div>

                                        @endif

                                    </div>
                                    <!-- Invoice Company Details -->

                                    <!-- Invoice Customer Details -->

                                    <!-- Invoice Customer Details -->

                                    <!-- Invoice Items Details -->
                                    <div id=" " class="pt-2">
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
                                                        @foreach ($currentProducts->slice(0, 5) as $key => $product)

                                                            <tr>
                                                                <th scope="row">{{ ++$key }}</th>
                                                                <td>
                                                                    @if ($product->product_id > 0)
                                                                        <p>{{ $product->product->product_name }}</p>
                                                                    @else
                                                                        {{ $product->product_temp }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-right">
                                                                    {{ $product->product_price }}
                                                                    ج.م</td>
                                                                <td class="text-right">
                                                                    {{ $product->product_qty }}</td>
                                                                <td class="text-right">
                                                                    {{ $product->product_price * $product->product_qty }}
                                                                    ج.م</td>
                                                            </tr>
                                                            <span
                                                                style="display: none">{{ $subtotal += $product->product_price * $product->product_qty }}</span>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>


                                    @if ($count <= 3)
                                        <div class="row ">
                                            <div class="col-sm-7 col-12 text-center text-sm-left">
                                                <h6>الشروط / الملاحظات</h6>
                                                {!! $invoice->quotation_note !!}


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
                                                                        {{ round(($invoice->discount_percentage / 100) * $subtotal) }}
                                                                        ج.م
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @if ($invoice->discount_amount > 0)
                                                                <tr>
                                                                    <td>الخصم (المبلغ)</td>
                                                                    <td class="text-right">
                                                                        {{ $invoice->discount_amount }} ج.م</td>
                                                                </tr>
                                                            @endif
                                                            @if ($invoice->quotation_tax > 0)
                                                                <tr>
                                                                    <td>الضريبة</td>
                                                                    <td class="text-right">
                                                                        [{{ $invoice->quotation_tax }} %]
                                                                        {{ round(($invoice->quotation_tax / 100) * $subtotal) }}
                                                                        ج.م</td>
                                                                </tr>
                                                            @endif
                                                            @if ($invoice->shipping_fees > 0)
                                                                <tr>
                                                                    <td>الشحن</td>
                                                                    <td class="text-right">
                                                                        {{ $invoice->shipping_fees }} ج.م</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td class="text-bold-800">الإجمالي</td>
                                                                <td class="text-bold-800 text-right">
                                                                    {{ $invoice->quotation_total }} ج.م</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-center">
                                                    <p class="mb-0 mt-1">التوقيع</p>
                                                    <img src="{{ asset($signature->user->signature) }}"
                                                        alt="signature" class="height-100" style="height: 100px;" />
                                                    <h6>{{ $signature->user->name }}</h6>
                                                    <p class="text-muted">{{ $signature->title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <span style="display: none">
                                            {{ $alreadyShown = 1 }}
                                        </span>

                                    @endif

                                </div>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($count > 5)
            <div class="page ">
                <div class="subpage notFirst">
                    <div id=" " class="pt-2">
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
                                        @foreach ($currentProducts->slice(5, 5) as $key => $product)

                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    @if ($product->product_id > 0)
                                                        <p>{{ $product->product->product_name }}</p>
                                                    @else
                                                        {{ $product->product_temp }}
                                                    @endif
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

                    </div>
                    @if ($count <= 7)
                        @if ($alreadyShown != 1) <span style="display:
                        none">
                                {{ $alreadyShown = 1 }}
                            </span>
                            <div class="row ">
                                <div class="col-sm-7 col-12 text-center text-sm-left">
                                    <h6>الشروط / الملاحظات</h6>
                                    {!! $invoice->quotation_note !!}


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
                                                            {{ round(($invoice->discount_percentage / 100) * $subtotal) }}
                                                            ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->discount_amount > 0)
                                                    <tr>
                                                        <td>الخصم (المبلغ)</td>
                                                        <td class="text-right">{{ $invoice->discount_amount }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->quotation_tax > 0)
                                                    <tr>
                                                        <td>الضريبة</td>
                                                        <td class="text-right">
                                                            [{{ $invoice->quotation_tax }} %]
                                                            {{ round(($invoice->quotation_tax / 100) * $subtotal) }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->shipping_fees > 0)
                                                    <tr>
                                                        <td>الشحن</td>
                                                        <td class="text-right">{{ $invoice->shipping_fees }} ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-bold-800">الإجمالي</td>
                                                    <td class="text-bold-800 text-right">
                                                        {{ $invoice->quotation_total }} ج.م</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <p class="mb-0 mt-1">التوقيع</p>
                                        <img src="{{ asset($signature->user->signature) }}" alt="signature"
                                            class="height-100" style="height: 100px;" />
                                        <h6>{{ $signature->user->name }}</h6>
                                        <p class="text-muted">{{ $signature->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endif







        @if ($count > 10)
            <div class="page ">
                <div class="subpage notFirst">
                    <div id=" " class="pt-2">
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
                                        @foreach ($currentProducts->slice(10, 5) as $key => $product)

                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    @if ($product->product_id > 0)
                                                        <p>{{ $product->product->product_name }}</p>
                                                    @else
                                                        {{ $product->product_temp }}
                                                    @endif
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

                    </div>
                    @if ($count <= 12)
                        @if ($alreadyShown != 1) <span style="display:
                    none">
                                {{ $alreadyShown = 1 }}
                            </span>
                            <div class="row ">
                                <div class="col-sm-7 col-12 text-center text-sm-left">
                                    <h6>الشروط / الملاحظات</h6>
                                    {!! $invoice->quotation_note !!}


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
                                                            {{ round(($invoice->discount_percentage / 100) * $subtotal) }}
                                                            ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->discount_amount > 0)
                                                    <tr>
                                                        <td>الخصم (المبلغ)</td>
                                                        <td class="text-right">{{ $invoice->discount_amount }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->quotation_tax > 0)
                                                    <tr>
                                                        <td>الضريبة</td>
                                                        <td class="text-right">
                                                            [{{ $invoice->quotation_tax }} %]
                                                            {{ round(($invoice->quotation_tax / 100) * $subtotal) }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->shipping_fees > 0)
                                                    <tr>
                                                        <td>الشحن</td>
                                                        <td class="text-right">{{ $invoice->shipping_fees }} ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-bold-800">الإجمالي</td>
                                                    <td class="text-bold-800 text-right">
                                                        {{ $invoice->quotation_total }} ج.م</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <p class="mb-0 mt-1">التوقيع</p>
                                        <img src="{{ asset($signature->user->signature) }}" alt="signature"
                                            class="height-100" style="height: 100px;" />
                                        <h6>{{ $signature->user->name }}</h6>
                                        <p class="text-muted">{{ $signature->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endif




        @if ($count > 15)
            <div class="page ">
                <div class="subpage notFirst">
                    <div id=" " class="pt-2">
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
                                        @foreach ($currentProducts->slice(15, 5) as $key => $product)

                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    @if ($product->product_id > 0)
                                                        <p>{{ $product->product->product_name }}</p>
                                                    @else
                                                        {{ $product->product_temp }}
                                                    @endif
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

                    </div>
                    @if ($count <= 17)
                        @if ($alreadyShown != 1) <span style="display:
                    none">
                                {{ $alreadyShown = 1 }}
                            </span>
                            <div class="row ">
                                <div class="col-sm-7 col-12 text-center text-sm-left">
                                    <h6>الشروط / الملاحظات</h6>
                                    {!! $invoice->quotation_note !!}


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
                                                            {{ round(($invoice->discount_percentage / 100) * $subtotal) }}
                                                            ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->discount_amount > 0)
                                                    <tr>
                                                        <td>الخصم (المبلغ)</td>
                                                        <td class="text-right">{{ $invoice->discount_amount }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->quotation_tax > 0)
                                                    <tr>
                                                        <td>الضريبة</td>
                                                        <td class="text-right">
                                                            [{{ $invoice->quotation_tax }} %]
                                                            {{ round(($invoice->quotation_tax / 100) * $subtotal) }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->shipping_fees > 0)
                                                    <tr>
                                                        <td>الشحن</td>
                                                        <td class="text-right">{{ $invoice->shipping_fees }} ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-bold-800">الإجمالي</td>
                                                    <td class="text-bold-800 text-right">
                                                        {{ $invoice->quotation_total }} ج.م</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <p class="mb-0 mt-1">التوقيع</p>
                                        <img src="{{ asset($signature->user->signature) }}" alt="signature"
                                            class="height-100" style="height: 100px;" />
                                        <h6>{{ $signature->user->name }}</h6>
                                        <p class="text-muted">{{ $signature->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endif









        @if ($count > 20)
            <div class="page ">
                <div class="subpage notFirst">
                    <div id=" " class="pt-2">
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
                                        @foreach ($currentProducts->slice(20, 5) as $key => $product)

                                            <tr>
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    @if ($product->product_id > 0)
                                                        <p>{{ $product->product->product_name }}</p>
                                                    @else
                                                        {{ $product->product_temp }}
                                                    @endif
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

                    </div>
                    @if ($count <= 22)
                        @if ($alreadyShown != 1) <span style="display:
                    none">
                                {{ $alreadyShown = 1 }}
                            </span>
                            <div class="row ">
                                <div class="col-sm-7 col-12 text-center text-sm-left">
                                    <h6>الشروط / الملاحظات</h6>
                                    {!! $invoice->quotation_note !!}


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
                                                            {{ round(($invoice->discount_percentage / 100) * $subtotal) }}
                                                            ج.م
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->discount_amount > 0)
                                                    <tr>
                                                        <td>الخصم (المبلغ)</td>
                                                        <td class="text-right">{{ $invoice->discount_amount }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->quotation_tax > 0)
                                                    <tr>
                                                        <td>الضريبة</td>
                                                        <td class="text-right">
                                                            [{{ $invoice->quotation_tax }} %]
                                                            {{ round(($invoice->quotation_tax / 100) * $subtotal) }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                @if ($invoice->shipping_fees > 0)
                                                    <tr>
                                                        <td>الشحن</td>
                                                        <td class="text-right">{{ $invoice->shipping_fees }}
                                                            ج.م</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-bold-800">الإجمالي</td>
                                                    <td class="text-bold-800 text-right">
                                                        {{ $invoice->quotation_total }} ج.م</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-center">
                                        <p class="mb-0 mt-1">التوقيع</p>
                                        <img src="{{ asset($signature->user->signature) }}" alt="signature"
                                            class="height-100" style="height: 100px;" />
                                        <h6>{{ $signature->user->name }}</h6>
                                        <p class="text-muted">{{ $signature->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endif

























        @if ($alreadyShown != 1)


            <div class="page ">
                <div class="subpage notFirst">
                    <div class="row ">
                        <div class="col-sm-7 col-12 text-center text-sm-left">
                            <h6>الشروط / الملاحظات</h6>
                            {!! $invoice->quotation_note !!}


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
                                                    {{ round(($invoice->discount_percentage / 100) * $subtotal) }}
                                                    ج.م
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($invoice->discount_amount > 0)
                                            <tr>
                                                <td>الخصم (المبلغ)</td>
                                                <td class="text-right">{{ $invoice->discount_amount }} ج.م</td>
                                            </tr>
                                        @endif
                                        @if ($invoice->quotation_tax > 0)
                                            <tr>
                                                <td>الضريبة</td>
                                                <td class="text-right">
                                                    [{{ $invoice->quotation_tax }} %]
                                                    {{ round(($invoice->quotation_tax / 100) * $subtotal) }} ج.م
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
                                            <td class="text-bold-800 text-right"> {{ $invoice->quotation_total }}
                                                ج.م</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <p class="mb-0 mt-1">التوقيع</p>
                                <img src="{{ asset($signature->user->signature) }}" alt="signature"
                                    class="height-100" style="height: 100px;" />
                                <h6>{{ $signature->user->name }}</h6>
                                <p class="text-muted">{{ $signature->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
    <script>
        window.onload = function() {
            window.print();
            // window.close();
        }
        // window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
    </script>
</body>

</html>
