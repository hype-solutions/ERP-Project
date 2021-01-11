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
                    <li class="breadcrumb-item active">تحويل الى فاتورة
                    </li>
                  </ol>
                </div>
              </div>
            </div>

          </div>
          <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تحويل عرض السعر رقم <button class="btn-dark" type="button">{{$invoice->id}}</button> الى فاتورة مبيعات</h4>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <p>مراجعة على  <code class="highlighter-rouge">الأصناف</code> الموجودة في عرض السعر و  <code class="highlighter-rouge">الكميات</code>
                                    </p>
                            </div>
                            <div class="table-responsive">
                                <span style="display: none">
                                {{$checkError = 0}}
                                </span>
                                <table class="table">
                                    <thead class="bg-dark white">
                                        <tr>
                                            <th>#</th>
                                            <th>البند</th>
                                            <th>الوصف</th>
                                            <th>الكمية</th>
                                            <th>الحالة</th>
                                            <th>التحكم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentProducts as $key => $item)
                                        {{-- Select all from branches_products where product_id = $item->id and branch_id = 1 --}}
                                        <tr >
                                            <th scope="row">{{++$key}}</th>
                                            <td>
                                                @if ($item->product_id > 0)
                                                {{$item->product->product_name}}
                                                @else
                                                {{$item->product_temp}}
                                                @endif
                                            </td>
                                            <td>{{$item->product_desc}}</td>
                                            <td>{{$item->product_qty}}</td>
                                            <td>
                                                @if ($item->product_id > 0)
                                                <div class="badge badge-primary">
                                                    <i class="la la-check font-medium-2"></i>
                                                        <span>صنف موجود بالمخزن</span>
                                                    </div>
                                                    <br>
                                                @else
                                                <span style="display: none">{{$checkError = 1}}</span>
                                                <div class="badge badge-danger">
                                                    <i class="la la-info-circle font-medium-2"></i>
                                                        <span>صنف غير موجود بالمخزن</span>
                                                    </div>
                                                    <br>
                                                @endif
                                                @if(isset($item->check->id))
                                                    @if($item->check->amount < $item->product_qty)
                                                    <span style="display: none">{{$checkError = 1}}</span>
                                                <div class="badge badge-warning">
                                                    <i class="la la-info-circle font-medium-2"></i>
                                                        <span>الكمية المعروضة أقل من الموجودة بالمخزن</span>
                                                    </div>
                                                    @else
                                                    <div class="badge badge-success">
                                                        <i class="la la-check font-medium-2"></i>
                                                            <span>الكمية المعروضة موجودة بالمخزن</span>
                                                        </div>
                                                    @endif
                                                @else
                                                <span style="display: none">{{$checkError = 1}}</span>
                                                <div class="badge badge-warning">
                                                    <i class="la la-info-circle font-medium-2"></i>
                                                        <span>لا توجد كمية</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->product_id > 0)
                                                    @if(!isset($item->check->id))
                                                    <a class="btn btn-success" target="_blank" href="{{route('products.view',$item->product_id)}}">
                                                        <i class="la la-plus font-medium-2"></i>
                                                            <span>فتح ملف المنتج لإضافة كميات</span>
                                                    </a>
                                                    @endif
                                                @else
                                                <form action="{{route('invoicespricequotations.quickadd')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_name" value="{{$item->product_temp}}" />
                                                    <input type="hidden" name="product_price" value="{{$item->product_price}}" />
                                                    <input type="hidden" name="quotation_id" value="{{$invoice->id}}" />
                                                    <input type="hidden" name="record" value="{{$item->id}}" />
                                                <button class="btn btn-success">
                                                    <i class="la la-plus font-medium-2"></i>
                                                        <span>إضافته كصنف جديد</span>
                                                    </button>
                                                </form>
                                                @endif
                                                @if(isset($item->check->id))
                                                    @if($item->check->amount < $item->product_qty)
                                                    <a class="btn btn-success" target="_blank" href="{{route('products.view',$item->product_id)}}">
                                                        <i class="la la-plus font-medium-2"></i>
                                                            <span>فتح ملف المنتج لإضافة كميات</span>
                                                    </a>
                                                    @endif
                                                @else

                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <br>
                            <br>
                            @if($checkError == 0)
                            <a class="btn btn-block btn-primary" href="{{route('invoicespricequotations.converting',$invoice->id)}}">تحويل الى عرض سعر</a>
                            @else
                            <button class="btn btn-block btn-primary" title="برجاء مراجعة الأصناف" disabled>تحويل الى فاتورة مبيعات</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/pages/invoice-template.min.js') }}"></script>
    <!-- END: Theme JS-->

    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/editors/editor-ckeditor.min.js') }}"></script> --}}
    <script>


        </script>

 @endsection

