@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/switch.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-switch.min.css') }}">
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')

<div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- users view start -->
<section class="users-view">
    @if ($errors->any())
                            <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>حدث خطأ, برجاء المحاولة مرة أخرى</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif



                            @if(session()->has('success'))
                            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>تم بنجاح!</strong> تحديث ملف المنتج
                            </div>
                            @endif
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('safes.list')}}">الخزن</a></li>
                <li class="breadcrumb-item active">تحويل أموال بين الخزن
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/safe.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>

      </div>
    </div>

  </div>
<form method="POST" action="{{route('safes.transfering')}}">
      @csrf

      <input type="hidden" name="transfered_by" value="{{ $user_id }}" />
  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-flag"></i> من</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         اختر الخزنة
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_from"  onchange="return fetchAmount(this)" required>
                                            <option></option>
                                            @foreach ($safes as $safe)
                                            <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput3">المبلغ</label>
                                        <input type="number" id="amountToTransfer" class="form-control" placeholder="0.00" name="transfer_amount" min="1" max="2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput4">الرصيد قبل التحويل</label>
                                        <input type="number" id="amountBeforeTransfer1" class="form-control" placeholder="0" name="amount_before_transfer_from" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput4">الرصيد بعد التحويل</label>
                                        <input type="number" id="amountAfterTransfer1" class="form-control" placeholder="0" name="amount_after_transfer_from" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-arrow-circle-o-left"></i> الى</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         اختر الخزنة
                                        </div>
                                        <select class="select2-rtl form-control" id="toSafe" data-placeholder="إختر الخزنة..." name="safe_to" onchange="return fetchAmount2(this)" required>
                                            <option></option>
                                            @foreach ($otherSafes as $safe)
                                            <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4">الرصيد قبل التحويل</label>
                                        <input type="number" id="amountBeforeTransfer2" class="form-control" placeholder="0" name="amount_before_transfer_to" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4">الرصيد بعد التحويل</label>
                                        <input type="number" id="amountAfterTransfer2" class="form-control" placeholder="0" name="amount_after_transfer_to" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="projectinput8">التاريخ</label>
                                        <input type="datetime-local" name="transfer_datetime" class="form-control" id="dateTime" value="2011-08-19T13:45:00">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput8">الملاحظات</label>
                                        <textarea id="projectinput8" rows="5" class="form-control" name="transfer_notes"></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>


                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> تحويل</button>

                </div>
            </div>
        </div>
      </div>
  </div>

</form>
</section>
<!-- users view ends -->
        </div>
      </div>



@include('common.footer')
@endsection


@section('pageJs')


<script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>

<!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
    <script>
        function fetchAmount(safeId){
            $("#toSafe").attr({"readonly" : true });
            fetchOtherSafes(safeId);
            $('#amountToTransfer').val('');
            $('#amountAfterTransfer1').val(0);
            $('#amountBeforeTransfer2').val(0);
            $('#amountAfterTransfer2').val(0);

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            safe: safeId.value,
        };
        var type = "POST";
        var ajaxurl = "{{route('safes.fetchAmount')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#toSafe").attr({"readonly" : false });
                $("#amountBeforeTransfer1").val(data.amount);
                // if(data.amount > 0){
                //     $("#amountToTransfer").attr({"readonly" : false });
                // }else{
                //     $("#amountToTransfer").attr({"readonly" : true });
                // }
                 $("#amountToTransfer").attr({"max" : data.amount });
            },
            error: function (data) {
                console.log(data);
            }
        });

        }

        function fetchAmount2(safeId){
            //fetchOtherBranches(branchId);

            $('#amountAfterTransfer2').val(0);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            safe: safeId.value,
        };
        var type = "POST";
        var ajaxurl = "{{route('safes.fetchAmount')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#amountBeforeTransfer2").val(data.amount);
                $("#amountToTransfer").attr({"readonly" : false });
                $("#amountToTransfer").attr({"class" : "form-control border-success" });
            },
            error: function (data) {
                console.log(data);
            }
        });



        }



        function fetchOtherSafes(safeId){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            other_id: safeId.value,
        };
        var type = "POST";
        var ajaxurl = "{{route('safes.fetchOtherSafes')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var $otherSafe = $('#toSafe');
                $otherSafe.empty();
                for (var i = 0; i < data.length; i++) {
                $otherSafe.append('<option></option>');
                $otherSafe.append('<option value=' + data[i].id + '>' + data[i].safe_name + '</option>');
            }
            },
            error: function (data) {
                console.log(data);
            }
        });
        }



                $(document).ready(function () {

                    $("#amountToTransfer").bind('keyup mouseup', function () {


                    transQty = $('#amountToTransfer').val();
                    getQty = $('#amountBeforeTransfer1').val();
                    calculate = getQty - transQty;

                    toQty = $('#amountBeforeTransfer2').val();
                    calculate2 = parseInt(toQty) + parseInt(transQty);
                    $('#amountAfterTransfer1').val(calculate);
                    $('#amountAfterTransfer2').val(calculate2);
                });

            });
            </script>

 @endsection
