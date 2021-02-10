@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/invoice.min.css') }}">
<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

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
                    <li class="breadcrumb-item active">التصديق على أمر شراء
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
                            <h4 class="card-title">التصديق على أمر شراء رقم <button class="btn-dark" type="button">{{$purchaseOrder}}</button> و الدفع</h4>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <p>مراجعة على  <code class="highlighter-rouge">الأصناف</code> الموجودة في أمر الشراء و  <code class="highlighter-rouge">الكميات</code>
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


                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <br>
                            <form action="{{route('purchasesorders.accepting',$purchaseOrder)}}" method="POST">
                                @csrf
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12" id="notPaid">
                                                <div class="form-group">
                                                <select class="form-control" id="payment_method" name="payment_method" placehoder="حدد طريقة الدفع" required>
                                                    <option value="" disabled selected>إختر وسيلة الدفع</option>
                                                    <option value="cash">كاش</option>
                                                    <option value="visa">فيزا</option>
                                                    <option value="later">اجل (دفعات)</option>
                                                    <option value="bankTransfer">تحويل بنكي</option>
                                                </select>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="other_box" style="display: none">
                                <div class="card">
                                    <div class="card-body">

                                <div class="div">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="projectinput3">إختر الخزنة التي سيتم التوريد بها</label>
                                            <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id" id="safe_id">
                                                <option></option>
                                                @foreach ($safes as $safe)
                                                <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput3">الملاحظات</label>
                                                <textarea placeholder="مثال: رقم الحوالة" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>




                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="later_box" style="display: none">
                                <div class="card">
                                    <div class="card-body">

                                <div >
                                    <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button onclick="addDofaa()" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i></button></h4>
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dofaaTable">
                                        <thead>
                                            <tr>
                                                <th>المبلغ</th>
                                                <th>تاريخ الإستحقاق</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-group">
                                                        <input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later[1][amount]" value="0">
                                                    </div>
                                                </th>
                                                <td>
                                                    <fieldset class="form-group">
                                                    <input type="date" class="form-control"  id="laterDate" name="later[1][date]">
                                                </fieldset>
                                                <fieldset class="form-group">
                                                    <div class="labrl">الملاحظات</div>
                                                    <textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[1][notes]"></textarea>
                                                </fieldset>
                                            </td>


                                            </tr>

                                        </tbody>
                                    </table>
                                    </div>
                                </div>



                                    </div>
                                </div>
                            </div>


                            <br>
                            @if($checkError == 0)
                            <button type="submit" class="btn btn-block btn-primary">تصديق على أمر الشراء و الدفع</button>
                            @else
                            <button class="btn btn-block btn-primary" title="برجاء مراجعة الأصناف" disabled>تصديق على أمر الشراء و الدفع</button>
                            @endif

                        </form>
                        </div>
                    </div>
                </div>
            </div>
                  </div>
      </div>

@include('common.footer')
@endsection

@section('pageJs')

<script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script> --}}
{{-- <script src="{{ asset('theme/app-assets/vendors/js/editors/ckeditor/ckeditor-super-build.js') }}"></script> --}}

<!-- BEGIN: Theme JS-->



    <script src="{{ asset('theme/app-assets/js/scripts/pages/invoice-template.min.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/app-assets/js/scripts/editors/editor-ckeditor.min.js') }}"></script> --}}
    <script>


function addDofaa()
{

var dofaaTable = document.getElementById("dofaaTable");
var currentIndex = dofaaTable.rows.length;
var currentRow = dofaaTable.insertRow(-1);


var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<div class="form-group"><input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later['+currentIndex+'][amount]" value="0" required></div>';

var currentCell = currentRow.insertCell(-1);
currentCell.innerHTML = '<fieldset class="form-group"><input type="date" class="form-control" name="later['+currentIndex+'][date]" required></fieldset><fieldset class="form-group"><textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later['+currentIndex+'][notes]"></textarea></fieldset>';

}


$(document).ready(function () {
$('#payment_method').on('change', function() {
if (this.value == 'later') {
  //$('#init_box').hide();
  $('#other_box').hide();
  $('#later_box').show();
  $('#hasPaid').prop( "checked", false );
  $('#laterDate').prop( "required", true );
  $('#safe_id').prop( "required", false );

} else if (this.value == 'cash' || this.value == 'visa' || this.value == 'bankTransfer') {
  //$('#init_box').hide();
  $('#later_box').hide();
  $('#other_box').show();
  $('#hasPaid').prop( "checked", true );
  $('#laterDate').prop( "required", false );
  $('#safe_id').prop( "required", true );
} else {
  $('#later_box').hide();
  $('#other_box').hide();
  $('#init_box').show();
  $('#hasPaid').prop( "checked", false );
}
});
});

        </script>

 @endsection

