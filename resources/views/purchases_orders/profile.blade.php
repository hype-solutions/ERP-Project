@extends('layouts.erp')
@section('title', 'إستعراض أمر شراء رقم #'.$purchaseOrder->id)

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/invoice.min.css') }}">
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
              <h3 class="content-header-title mb-0">أوامر الشراء</h3>
              <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('purchasesorders.list')}}">أوامر الشراء</a></li>
                    <li class="breadcrumb-item active">استعراض
                    </li>
                  </ol>
                </div>
              </div>
            </div>

          </div>
          <div class="content-body"><section class="card">
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
                  <h2>أمر شراء</h2>
                  <p class="pb-sm-3">رقم {{$purchaseOrder->id}}</p>
                  <ul class="px-0 list-unstyled">
                    <li>إجمالي الفاتورة</li>
                    <li class="lead text-bold-800">{{$purchaseOrder->purchase_total}} ج.م</li>
                  </ul>
                </div>
              </div>
              <!-- Invoice Company Details -->

              <!-- Invoice Customer Details -->
              <div id="invoice-customer-details" class="row pt-2">
                <div class="col-12 text-center text-sm-left">
                  <p class="text-muted">بيانات المورد</p>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-left">
                  <ul class="px-0 list-unstyled">
                    <li class="text-bold-800">{{$purchaseOrder->supplier->supplier_name}}</li>
                    <li>موبايل: {{ $purchaseOrder->supplier->supplier_mobile }}</li>
                    <li>@if(isset($purchaseOrder->supplier->supplier_phone))
                        هاتف: {{ $purchaseOrder->supplier->supplier_phone }}
                        @else
                        <small style="font-style: italic;color:red;">لا يوجد هاتف مسجل</small>
                        @endif</li>
                    <li>@if(isset($purchaseOrder->supplier->supplier_address))
                        العنوان: {{ $purchaseOrder->supplier->supplier_address }}
                        @else
                        <small style="font-style: italic;color:red;">لا يوجد عنوان مسجل </small>
                         @endif</li>

                  </ul>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-right">
                  <p><span class="text-muted">تاريخ الفاتورة: </span> {{$purchaseOrder->purchase_date}}</p>
                  <p><span class="text-muted">الدفع:</span>
                    @if($purchaseOrder->already_paid)
                    تم الدفع
                    @else
                     لم يتم الدفع
                    @endif
                </p>
                  <p><span class="text-muted">الإستلام:</span>
                    @if($purchaseOrder->already_delivered)
                    تم الإستلام
                    @else
                     لم يتم الإستلام
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
                                    @if($purchaseOrder->payment_method == 'cash')
                                    <span>كاش</span>
                                    @elseif($purchaseOrder->payment_method == 'visa')
                                    <span>فيزا</span>
                                    @elseif($purchaseOrder->payment_method == 'later')
                                    <span>أجل</span>
                                    @endif
                                </td>
                              </tr>
                              @if($purchaseOrder->already_paid)
                                @if($purchaseOrder->payment_method !='later')
                                    <tr>
                                        <td>رقم فاتورة الدفع:</td>
                                        <td class="text-right">{{$purchaseOrder->safe_payment_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>الخزنة المخصوم منها:</td>
                                        <td class="text-right">{{$purchaseOrder->safe->safe_name}}</td>
                                    </tr>
                                @endif
                              @endif
                            </tbody>
                          </table>
                        </div>
                        @if($purchaseOrder->payment_method == 'later')
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
                    @if($purchaseOrder->already_delivered)
                    <p class="lead">الإستلام:</p>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="table-responsive">
                          <table class="table table-borderless table-sm">
                            <tbody>
                              <tr>
                                <td>تاريخ الإستلام</td>
                                <td class="text-right">{{$purchaseOrder->delivery_date}}</td>
                              </tr>
                              <tr>
                                <td>الفرع المستلم</td>
                                <td class="text-right">{{$purchaseOrder->branch->branch_name}}</td>
                            </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    @endif
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
                          @if($purchaseOrder->discount_percentage > 0)
                          <tr>
                            <td>الخصم (النسبة)</td>
                            <td class="text-right">
                                [{{$purchaseOrder->discount_percentage}} %]
                                @if(preg_match('/^\d+\.\d+$/',($purchaseOrder->discount_percentage / 100) * $subtotal)) * @endif
                                {{(($purchaseOrder->discount_percentage / 100) * $subtotal)}} ج.م
                            </td>
                          </tr>
                          @endif
                          @if($purchaseOrder->discount_amount > 0)
                          <tr>
                            <td>الخصم (المبلغ)</td>
                            <td class="text-right">{{$purchaseOrder->discount_amount}} ج.م</td>
                          </tr>
                          @endif
                          @if($purchaseOrder->purchase_tax > 0)
                          <tr>
                            <td>الضريبة</td>
                            <td class="text-right">
                                [{{$purchaseOrder->purchase_tax}} %]
                                @if(preg_match('/^\d+\.\d+$/',($purchaseOrder->purchase_tax / 100) * $subtotal)) * @endif
                                {{round(($purchaseOrder->purchase_tax / 100) * $subtotal)}} ج.م
                            </td>
                          </tr>
                          @endif
                          @if($purchaseOrder->shipping_fees > 0)
                          <tr>
                            <td>الشحن</td>
                            <td class="text-right">{{$purchaseOrder->shipping_fees}} ج.م</td>
                          </tr>
                          @endif
                          <tr>
                            <td class="text-bold-800">الإجمالي</td>
                            <td class="text-bold-800 text-right"> {{$purchaseOrder->purchase_total}} ج.م</td>
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

              <!-- Invoice Footer -->
              <div id="invoice-footer">
                <div class="row">
                  <div class="col-sm-7 col-12 text-center text-sm-left">
                    <h6>الشروط / الملاحظات</h6>
                    {{$purchaseOrder->purchase_note}}
                  </div>
                  <div class="col-sm-5 col-12 text-center">
                    <button type="button" class="btn btn-info btn-print btn-lg my-1" onclick="print()"><i class="la la-paper-plane-o mr-50"></i>
                      طباعة الفاتورة</button>
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

