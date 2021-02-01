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
                    <li class="breadcrumb-item active">توريد الى المخزن
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
                            <h4 class="card-title">توريد الى المخزن أمر شراء رقم <button class="btn-dark" type="button">{{$purchaseOrder->id}}</button> الى المخزن</h4>

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
                            <form action="{{route('purchasesorders.importing',$purchaseOrder->id)}}" method="POST">
                                @csrf
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">


            <div class="div" id="delivery_info">
                <fieldset class="form-group">
                    <div class="label">تاريخ الإستلام</div>
                    <input type="date" class="form-control" id="delDate"  name="delivery_date" required>
                </fieldset>
                <div class="form-group">
                    <label> اختر الفرع (المخزن) المستلم:</label>


                    <select class="select2-rtl form-control" id="delBranch" data-placeholder="إختر الفرع..." name="branch_id" required>

                        <option></option>

                        @foreach ($branches as $branch)
                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
                                    </div>
                                </div>
                            </div>




                            <br>
                            @if($checkError == 0)
                            <button type="submit" class="btn btn-block btn-primary">توريد</button>
                            @else
                            <button class="btn btn-block btn-primary" title="برجاء مراجعة الأصناف" disabled>توريد</button>
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
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
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

