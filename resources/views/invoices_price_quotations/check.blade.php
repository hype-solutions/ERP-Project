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

                                        <tr>
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
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <br>
                            <br>
                            <a class="btn btn-block btn-primary" href="{{route('invoicespricequotations.converting',$invoice->id)}}">تحويل الى عرض سعر</a>
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

