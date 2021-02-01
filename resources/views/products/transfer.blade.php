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
            <li class="breadcrumb-item"><a href="{{route('products.list')}}">المنتجات</a></li>
                <li class="breadcrumb-item active">تحويل كميات بين الفروع
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/product.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $product->product_name }} </span>
            </h4>
          <span>رقم المنتج:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $product->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-2 mb-2">
        <div class="btn-group mr-1 mb-1">
         <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم في المنتج</button>
         <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
             <a class="dropdown-item" href="{{ route('products.view', $product->id) }}">استعراض المنتج</a>
             <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">تعديل المنتج</a>
             <a class="dropdown-item" href="#">طباعه BARCODE</a>
             <div class="dropdown-divider"></div>

         </div>
     </div>
     <div class="btn-group mr-1 mb-1"  style="width: 100%;">
         <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التحكم في المخزون</button>
         <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
             {{-- <a class="dropdown-item" href="{{route('products.addQty',$product->id)}}">أضف كمية يدويا</a> --}}
             <a class="dropdown-item" href="#">أمر شراء جديد</a>
             <a class="dropdown-item" href="{{route('products.transfer',$product->id)}}">تحويل كميات بين الفروع</a>

         </div>
     </div>
     </div>
  </div>
<form method="POST" action="{{route('products.transfering')}}">
      @csrf

      <input type="hidden" name="product_id" value="{{ $product->id }} "/>
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
                                         اختر الفرع
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر الفرع..." name="branch_from"  onchange="return fetchQty(this)" required>
                                            <option></option>
                                            @foreach ($productBranches as $branch)
                                            <option value="{{$branch->branch_id}}">{{$branch->branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput3">الكمية</label>
                                        <input type="number" id="qtyToTransfer" class="form-control" placeholder="0.00" name="transfer_qty" min="1" max="2" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput4">الكمية قبل التحويل</label>
                                        <input type="number" id="qtyBeforeTransfer1" class="form-control" placeholder="0" name="qty_before_transfer_from" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput4">الكمية بعد التحويل</label>
                                        <input type="number" id="qtyAfterTransfer1" class="form-control" placeholder="0" name="qty_after_transfer_from" readonly>
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
                                         اختر الفرع
                                        </div>
                                        <select class="select2-rtl form-control" id="toBranch" data-placeholder="إختر الفرع..." name="branch_to" onchange="return fetchQty2(this)" required>
                                            <option></option>
                                            @foreach ($otherBranches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4">الكمية قبل التحويل</label>
                                        <input type="number" id="qtyBeforeTransfer2" class="form-control" placeholder="0" name="qty_before_transfer_to" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4">الكمية بعد التحويل</label>
                                        <input type="number" id="qtyAfterTransfer2" class="form-control" placeholder="0" name="qty_after_transfer_to" readonly>
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
                                        <input type="datetime-local" value="{{Carbon\Carbon::now()->format('Y-m-d')."T".Carbon\Carbon::now()->format('H:i')}}" name="transfer_datetime" class="form-control" id="dateTime" readonly required>
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
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/switch.min.js') }}"></script>
    <script>
        function fetchQty(branchId){
            $("#toBranch").attr({"readonly" : true });
            fetchOtherBranches(branchId);
            $('#qtyToTransfer').val('');
            $('#qtyAfterTransfer1').val(0);
            $('#qtyBeforeTransfer2').val(0);
            $('#qtyAfterTransfer2').val(0);


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            branch: branchId.value,
            product: "{{ $product->id }}",
        };
        var type = "POST";
        var ajaxurl = "{{route('products.fetchQty')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#toBranch").attr({"readonly" : false });
                $("#qtyBeforeTransfer1").val(data.amount);
                // if(data.amount > 0){
                //     $("#qtyToTransfer").attr({"readonly" : false });
                // }else{
                //     $("#qtyToTransfer").attr({"readonly" : true });
                // }
                 $("#qtyToTransfer").attr({"max" : data.amount });
            },
            error: function (data) {
                console.log(data);
            }
        });

        }

        function fetchQty2(branchId){
            //fetchOtherBranches(branchId);

            $('#qtyAfterTransfer2').val(0);
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            branch: branchId.value,
            product: "{{ $product->id }}",
        };
        var type = "POST";
        var ajaxurl = "{{route('products.fetchQty')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                $("#qtyBeforeTransfer2").val(data.amount);

            },
            error: function (data) {
                console.log(data);
            }
        });
        $("#qtyToTransfer").attr({"readonly" : false });
        $("#qtyToTransfer").attr({"class" : "form-control border-success" });


        }



        function fetchOtherBranches(branchId){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
                        });
        var formData = {
            other_id: branchId.value,
        };
        var type = "POST";
        var ajaxurl = "{{route('products.fetchOtherBranches')}}";
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var $otherBranch = $('#toBranch');
                $otherBranch.empty();
                for (var i = 0; i < data.length; i++) {
                $otherBranch.append('<option></option>');
                $otherBranch.append('<option value=' + data[i].id + '>' + data[i].branch_name + '</option>');
            }
            },
            error: function (data) {
                console.log(data);
            }
        });
        }



                $(document).ready(function () {

                    $("#qtyToTransfer").bind('keyup mouseup', function () {


                    transQty = $('#qtyToTransfer').val();
                    getQty = $('#qtyBeforeTransfer1').val();
                    calculate = getQty - transQty;

                    toQty = $('#qtyBeforeTransfer2').val();
                    calculate2 = parseInt(toQty) + parseInt(transQty);
                    $('#qtyAfterTransfer1').val(calculate);
                    $('#qtyAfterTransfer2').val(calculate2);
                });

            });
            </script>

 @endsection
