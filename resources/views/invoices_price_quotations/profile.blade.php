@extends('layouts.erp')

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
              <h3 class="content-header-title mb-0">عروض الأسعار</h3>
              <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('invoicespricequotations.list')}}">عروض الأسعار</a></li>
                    <li class="breadcrumb-item active">استعراض
                    </li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                @if($invoice->quotation_status == 'Pending Approval')
                <div class="badge badge-warning">
                  <i class="la la-hourglass-half font-medium-2"></i>
                      <span>في إنتظار موافقة الإدارة</span>
                  </div>
                @elseif($invoice->quotation_status == 'Approved')
                <div class="badge badge-success">
                  <i class="la la-star font-medium-2"></i>
                      <span>تمت الموافقة من الإدارة </span>
                  </div>
                  @elseif($invoice->quotation_status == 'Declined')
                  <div class="badge badge-danger">
                    <i class="la la-times-circle font-medium-2"></i>
                        <span>تم الرفض</span>
                    </div>
                    @elseif($invoice->quotation_status == 'ToInvoice')
                    <div class="badge badge-primary">
                      <i class="la la-newspaper-o font-medium-2"></i>
                          <span>تم التحويل الى فاتورة</span>
                      </div>
                @endif
            </div>

          </div>
          <div class="content-body"><section class="card">
            <div id="invoice-template" class="card-body p-4">
              <!-- Invoice Company Details -->
              <div id="invoice-company-details" class="row">
                <div class="col-sm-6 col-12 text-center text-sm-left">
                  <div class="media row">
                    <div class="col-12 col-sm-3 col-xl-2">
                      <img src="{{asset($logo)}}" alt="{{$company}}" class="mb-1 mb-sm-0" style="width: 80px;height:80px;"/>
                    </div>
                    <div class="col-12 col-sm-9 col-xl-10">
                      <div class="media-body">
                        <ul class="ml-2 px-0 list-unstyled">
                          <li class="text-bold-800">{{$company}}</li>
                          {{-- <li>العنوان 1</li>
                          <li>العنوان 2</li>
                          <li>المدينة</li>
                          <li>الدولة</li> --}}
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-right">
                  <h2>عرض سعر</h2>
                  <p class="pb-sm-3">رقم {{$invoice->id}}</p>
                  <ul class="px-0 list-unstyled">
                    <li>إجمالي عرض السعر</li>
                    <li class="lead text-bold-800">{{$invoice->quotation_total}} ج.م</li>
                  </ul>
                </div>
              </div>
              <!-- Invoice Company Details -->

              <!-- Invoice Customer Details -->
              <div id="invoice-customer-details" class="row pt-2">
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
                  <p><span class="text-muted">تاريخ عرض السعر: </span> {{$invoice->quotation_date}}</p>



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
                <div class="row">
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
                                @if(is_float(($invoice->discount_percentage / 100) * $subtotal)) <span style="color: rgb(170, 170, 26)">*</span> @endif
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
                                @if(is_string_float(($invoice->quotation_tax / 100) * $subtotal))
                                 <span style="color: rgb(170, 170, 26)">*</span>
                                @endif


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
                    {{-- <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset($userSig->signature)}}" alt="signature" class="height-100" style="height: 100px;" />
                      <h6>إسم الشخص</h6>
                      <p class="text-muted">الوظيفة</p>
                    </div> --}}
                    @env('local','development')
                    <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset($userSig->signature)}}" alt="signature" class="height-100" style="height: 100px;" />
                      <h6>إسم الشخص</h6>
                      <p class="text-muted">الوظيفة</p>
                    </div>
                    @endenv
                    @env('production')
                    @if(request()->getHttpHost() == 'e1.mygesture.co')
                    <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset($userSig->signature)}}" alt="signature" class="height-100" style="height: 100px;" />
                      <h6>م/ محمد عاطف</h6>
                      <p class="text-muted">المدير العام</p>
                    </div>
                    @elseif(request()->getHttpHost() == 'e2.mygesture.co')
                    <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset($userSig->signature)}}" alt="signature" class="height-100" style="height: 100px;" />
                      <h6>م/ أحمد عماد</h6>
                      <p class="text-muted">المدير العام</p>
                    </div>
                    @elseif(request()->getHttpHost() == 'e3.mygesture.co')
                    <div class="text-center">
                      <p class="mb-0 mt-1">التوقيع</p>
                      <img src="{{asset($userSig->signature)}}" alt="signature" class="height-100" style="height: 100px;" />
                      <h6>م/ محمد ممدوح</h6>
                      <p class="text-muted">المدير العام</p>
                    </div>
                    @endif
                  @endenv
                  </div>
                </div>
              </div>




              <!-- Invoice Footer -->
              <div id="invoice-footer">
                <div class="row">
                    @if($invoice->quotation_status != 'Pending Approval')
                  <div class="col-sm-5 col-12 text-center">
                    {{-- <button type="button" class="btn btn-info btn-print btn-lg my-1"><i class="la la-paper-plane-o mr-50"></i>
                      طباعة عرض السعر</button> --}}
                      <button class="btn btn-block btn-success btn-print" id="print1">طباعة على ورق أبيض</button>
                        أو
                      <a target="_blank" href="{{route('invoicespricequotations.print2',$invoice->id)}}" class="btn btn-block btn-info btn-print">طباعة على ورق ليتر هيد</a>
                      أو
                      <form action="{{route('invoicespricequotations.print3',$invoice->id)}}" method="POST">
                                        @csrf


                                        <div class="form-group">
                                          @env('local','development')
                                            <select class="form-control" name="template">
                                                <option value="1">التصميم رقم #1</option>
                                                <option value="2">التصميم رقم #2</option>
                                                <option value="3">التصميم رقم #3</option>
                                                <option value="4">التصميم رقم #4</option>
                                            </select>
                                            @endenv
                                            @env('production')
                                              @if(request()->getHttpHost() == 'e1.mygesture.co')
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
                                            <button type="submit" class="btn btn-block btn-dark btn-print">طباعة بالتصميم</button>

                                        </div>


                                    </form>
                  </div>
                  @else
                  <span style="color: red">في انتظار موافقة الإدارة كي يمكنك إرسالها للعميل أو طباعتها</span>
                @endif
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


    <script src="{{ asset('theme/app-assets/js/scripts/pages/invoice-template.min.js') }}"></script>


    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/editors/editor-ckeditor.min.js') }}"></script> --}}
    <script>


        </script>

 @endsection

