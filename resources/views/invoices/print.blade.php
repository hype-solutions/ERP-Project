    <html>
    <head>
        <title>طباعة</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/vendors-rtl.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/custom-rtl.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/invoices.min3.css') }}" id="printCss">


<link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style-rtl.css') }}">
@if($p == 3)
<style>
    #invoice-template {
    /* background-image:url(/uploads/letterHead1.jpg) !important; */
    /* background-image:url({{url('uploads/letterHead1.jpg')}}) !important; */
    background-image:url('{{ url('uploads/letterHead1.jpg')}}')!important;

    background-repeat:no-repeat;
    background-size: 100% 100%;
}
</style>
@endif
    </head>
<body>
<div class="app-content content">
<div class="content-overlay"></div>
      <div class="content-wrapper">

          <div class="content-body"><section class="card">
            <div id="invoice-template" class="card-body p-4" style="min-height:1320px;">
              <!-- Invoice Company Details  3508 x 2480   -->

              <!-- Invoice Company Details -->

              <!-- Invoice Customer Details -->
              <div id="invoice-customer-details" class="row pt-2" style="    margin-top: 90px;">
                <div class="col-12 text-center text-sm-left">
                  <p class="text-muted">بيانات العميل</p>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-left">
                  <ul class="px-0 list-unstyled">
                    <li class="text-bold-800">{{$invoice->customer->customer_name}}</li>
                    <li>موبايل: {{ $invoice->customer->customer_mobile }}</li>
                    <li>@if(isset($invoice->customer->customer_phone))
                        هاتف: {{ $invoice->customer->customer_phone }}
                        @else
                        <small style="font-style: italic;color:red;">لا يوجد هاتف مسجل</small>
                        @endif</li>
                    <li>@if(isset($invoice->customer->customer_address))
                        العنوان: {{ $invoice->customer->customer_address }}
                        @else
                        <small style="font-style: italic;color:red;">لا يوجد عنوان مسجل </small>
                         @endif</li>

                  </ul>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-right">
                    <h2>فاتورة مبيعات</h2>
                  <p class="pb-sm-3">رقم {{$invoice->id}}</p>
                  <ul class="px-0 list-unstyled">
                    <li>إجمالي الفاتورة</li>
                    <li class="lead text-bold-800">{{$invoice->invoice_total}} ج.م</li>
                  </ul>
                  <p><span class="text-muted">تاريخ الفاتورة: </span> {{$invoice->invoice_date}}</p>
                  <p><span class="text-muted">الدفع:</span>
                    @if($invoice->already_paid)
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
                          <th>البند  و الوصف</th>
                          <th class="text-right">سعر الوحدة	</th>
                          <th class="text-right">الكمية</th>
                          <th class="text-right">المجموع</th>
                        </tr>
                      </thead>
                      <tbody>
                        <span style="display: none">{{$subtotal = 0}}</span>
                        @foreach ($currentProducts as $key => $product)

                        <tr>
                          <th scope="row">{{++$key}}</th>
                          <td>
                            <p>{{$product->product->product_name}}</p>
                            <p class="small"><em>{{$product->product->product_desc}}</em>
                            </p>
                          </td>
                          <td class="text-right">{{$product->product_price}} ج.م</td>
                          <td class="text-right">{{$product->product_qty}}</td>
                          <td class="text-right">{{$product->product_price * $product->product_qty}} ج.م</td>
                        </tr>
                        <span style="display: none">{{$subtotal += $product->product_price * $product->product_qty}}</span>
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
                                <td>طريقة الدفع</td>
                                <td class="text-right">
                                    @if($invoice->payment_method == 'cash')
                                    <span>كاش</span>
                                    @elseif($invoice->payment_method == 'visa')
                                    <span>فيزا</span>
                                    @elseif($invoice->payment_method == 'later')
                                    <span>أجل</span>
                                    @endif
                                </td>
                              </tr>
                              @if($invoice->already_paid)
                                @if($invoice->payment_method !='later')
                                    <tr>
                                        <td>رقم ايصال الدفع:</td>
                                        <td class="text-right">{{$invoice->safe_transaction_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>الخزنة التي تم الإيداع بها:</td>
                                        <td class="text-right">{{$invoice->safe->safe_name}}</td>
                                    </tr>
                                @endif
                              @endif
                            </tbody>
                          </table>
                        </div>
                        @if($invoice->payment_method == 'later')
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
                                @foreach ($laterDates as $key2 => $item)
                                <tr>
                                    <th scope="row">
                                        {{$item->amount}}
                                    </th>
                                    <td>
                                        {{$item->date}}
                                        {{$item->notes}}
                                    </td>

                                    <td>
                                        @if($item->paid != 'No')
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
                                {{$subtotal}} ج.م
                            </td>
                          </tr>
                          @if($invoice->discount_percentage > 0)
                          <tr>
                            <td>الخصم (النسبة)</td>
                            <td class="text-right">
                                [{{$invoice->discount_percentage}} %]
                                {{round(($invoice->discount_percentage / 100) * $subtotal)}} ج.م
                            </td>
                          </tr>
                          @endif
                          @if($invoice->discount_amount > 0)
                          <tr>
                            <td>الخصم (المبلغ)</td>
                            <td class="text-right">{{$invoice->discount_amount}} ج.م</td>
                          </tr>
                          @endif
                          @if($invoice->invoice_tax > 0)
                          <tr>
                            <td>الضريبة</td>
                            <td class="text-right">
                                [{{$invoice->invoice_tax}} %]
                                {{round(($invoice->invoice_tax / 100) * $subtotal)}} ج.م
                            </td>
                          </tr>
                          @endif
                          @if($invoice->shipping_fees > 0)
                          <tr>
                            <td>الشحن</td>
                            <td class="text-right">{{$invoice->shipping_fees}} ج.م</td>
                          </tr>
                          @endif
                          <tr>
                            <td class="text-bold-800">الإجمالي</td>
                            <td class="text-bold-800 text-right"> {{$invoice->invoice_total}} ج.م</td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                     <div class="text-center">
                      {{-- <p class="mb-0 mt-1">التوقيع</p> --}}
                      {{-- <img src="{{asset('theme/app-assets/images/pages/signature-scan.png')}}" alt="signature" class="height-100" /> --}}
                      {{-- <h6>إسم الشخص</h6> --}}
                      {{-- <p class="text-muted">مدير المشتريات</p> --}}
                    </div>
                  </div>
                </div>
              </div>

              <!-- Invoice Footer -->
              <div id="invoice-footer">
                <div class="row">
                  <div class="col-sm-7 col-12 text-center text-sm-left">
                    <h6>الشروط / الملاحظات</h6>
                    {!!$invoice->invoice_note!!}
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
                                    {{-- <button class="btn btn-block btn-success btn-print" id="print1">طباعة على ورق أبيض</button>
                                    <button class="btn btn-block btn-info btn-print" id="print2">طباعة على ورق ليتر هيد</button>
                                    <button class="btn btn-block btn-dark btn-print" id="print3">طباعة بالتصميم</button> --}}
                  </div>
                </div>
              </div>
              <!-- Invoice Footer -->

            </div>
          </section>

                  </div>
      </div>
      </div>


{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js') }}"></script> --}}

<script src="{{ asset('theme/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/invoice-template.min.js') }}"></script> --}}
    <!-- END: Theme JS-->
      {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/editors/editor-ckeditor.min.js') }}"></script> --}}
    <script>

window.onload = function () {
    window.print();
    // window.close();
}
// window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }

        </script>


</body>
</html>
