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
<style>
  @page {
  size: auto;
  margin: 0;
}
@media print {
  html, body,  {
    width: 210mm;
    height: 297mm;
  }
  body{
    /* background-image:url('{{ url('uploads/letterHead3.jpg')}}')!important;
    background-size: 100% 100%; */
  }
  body {
    background-image:url('{{ url('uploads/letterHead3.jpg')}}')!important;
    background-repeat: repeat;
    background-size: 100% 100%;
    -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
  }
  .pagebreak { page-break-before: always; } /* page-break-after works, as well */

}
</style>
@if($p == 3)
        @if($template == 1)
        <style>
            #invoice-template {
            background-image:url('{{ url('uploads/letterHead1.jpg')}}')!important;
            background-repeat:repeat-y;
            background-size: 100% 100%;
        }
        </style>
        @elseif($template == 2)
        <style>
            #invoice-template {
            background-image:url('{{ url('uploads/letterHead2.jpg')}}')!important;
            background-repeat:repeat-y;
            background-size: 100% 100%;
        }
        </style>
        @elseif($template == 3)
        <style>
            body {
            background-image:url('{{ url('uploads/letterHead3.jpg')}}')!important;
            background-repeat:repeat-y;
            background-size: 100% 100%;
        }
      
        </style>
        @elseif($template == 4)
        <style>
            #invoice-template {
            background-image:url('{{ url('uploads/letterHead4.jpg')}}')!important;
            background-repeat:repeat-y;
            background-size: 100% 100%;
        }
        </style>
        @endif

@endif
    </head>
<body>
<div class="app-content content">
  <div class="content-overlay"></div>
      <div class="content-wrapper">

        <div class="content-body"><section class="">
            {{-- <div id="invoice-template" class="card-body p-4" style="min-height:1320px;"> --}}
            <div id="invoice-template" class="   ">
              <!-- Invoice Company Details -->
              <div id="invoice-customer-details" class="row pt-2" style="">

                <div class="col-sm-6 col-12 text-center text-sm-left" @if($template == 3) style="margin-top:100px;" @endif>
                    <p class="text-muted">بيانات العميل</p>
                  <ul class="px-0 list-unstyled">
                    <li class="text-bold-800">{{$invoice->customer->customer_name}}</li>
                    <li>موبايل: {{ $invoice->customer->customer_mobile }}</li>
                    <li>@if(isset($invoice->customer->customer_phone))
                        هاتف: {{ $invoice->customer->customer_phone }}
                        @endif</li>
                    <li>
                        @if(isset($invoice->customer->customer_address))
                        العنوان: {{ $invoice->customer->customer_address }}
                         @endif
                    </li>

                  </ul>
                </div>
                @if($template != 3)
                <div class="col-sm-6 col-12 text-center text-sm-right">
                    <h2>عرض سعر</h2>
                    <p class="pb-sm-3">رقم {{$invoice->id}}</p>
                    <ul class="px-0 list-unstyled">
                      <li>إجمالي عرض السعر</li>
                      <li class="lead text-bold-800">{{$invoice->quotation_total}} ج.م</li>
                    </ul>
                  </div>
                @else
                <div class="col-sm-2 col-12 text-center text-sm-right">
                    <h2>عرض سعر</h2>
                    <p class="pb-sm-3">رقم {{$invoice->id}}</p>
                    <ul class="px-0 list-unstyled">
                      <li>إجمالي عرض السعر</li>
                      <li class="lead text-bold-800">{{$invoice->quotation_total}} ج.م</li>
                    </ul>
                  </div>
                  <div class="col-sm-4 col-12 text-center text-sm-right">
                  </div>
                @endif
              </div>
              <!-- Invoice Company Details -->

              <!-- Invoice Customer Details -->

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
                            @if ($product->product_id > 0)
                            <p>{{$product->product->product_name}}</p>
                            @else
                            {{$product->product_temp}}
                            @endif
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
                <div class="row ">
                  <div class="col-sm-7 col-12 text-center text-sm-left">
                         <h6>الشروط / الملاحظات</h6>
                        {!!$invoice->quotation_note!!}


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
                          @if($invoice->quotation_tax > 0)
                          <tr>
                            <td>الضريبة</td>
                            <td class="text-right">
                                [{{$invoice->quotation_tax}} %]
                                {{round(($invoice->quotation_tax / 100) * $subtotal)}}  ج.م</td>
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
                            <td class="text-bold-800 text-right"> {{$invoice->quotation_total}} ج.م</td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                    <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset('theme/app-assets/images/pages/signature-scan.png')}}" alt="signature" class="height-100" />
                      <h6>إسم الشخص</h6>
                      <p class="text-muted">الوظيفة</p>
                    </div>
                  </div>
                </div>
              </div>




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
