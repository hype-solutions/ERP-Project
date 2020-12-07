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
                <li class="breadcrumb-item active">إضافه كمية يدويا
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
             <form action="{{route('products.delete',$product->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج نهائيا و جميع تفاصيله من البرنامج')">
                 @csrf
                 @method('delete')
             <button class="dropdown-item btn-danger btn" type="submit">حذف المنتج</button>
             </form>
         </div>
     </div>
     <div class="btn-group mr-1 mb-1"  style="width: 100%;">
         <button type="button" class="btn btn-info btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> التحكم في المخزون</button>
         <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
             <a class="dropdown-item" href="#">أضف كمية يدويا</a>
             <a class="dropdown-item" href="#">أمر شراء جديد</a>
             <a class="dropdown-item" href="#">تحويل كميات بين الفروع</a>

         </div>
     </div>
     </div>
  </div>
<form method="POST" action="{{route('products.addingQty')}}">
      @csrf

      <input type="hidden" name="product_id" value="{{ $product->id }} "/>
      <input type="hidden" name="added_by" value="{{ $user_id }}" />
  <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-flag"></i> إضافه كمية يدويا</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-bold-600 font-medium-2">
                                         اختر الفرع
                                        </div>
                                        <select class="select2-rtl form-control" data-placeholder="إختر الفرع..." name="branch_id"  onchange="return fetchQty(this)">
                                            <option></option>
                                            @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput3">الكمية</label>
                                        <input type="number" id="qtyToAdd" class="form-control" placeholder="0.00" name="qty" min="1" max="20000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput4">الكمية قبل الإضافة</label>
                                        <input type="number" id="qtyBeforeAdd" class="form-control" placeholder="0" name="qty_before_add" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="projectinput4">الكمية بعد الإضافة</label>
                                        <input type="number" id="qtyAfterAdd" class="form-control" placeholder="0" name="qty_after_add" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body">

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput3">سعر الشراء للوحدة</label>
                                        <input type="number" id="" class="form-control" placeholder="" name="qty_price" value="0" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="projectinput8">التاريخ</label>
                                        <input type="datetime-local" name="qty_datetime" class="form-control" id="dateTime" value="2011-08-19T13:45:00">
                                    </fieldset>
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

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput8">الملاحظات</label>
                                        <textarea id="projectinput8" rows="5" class="form-control" name="qty_notes"></textarea>
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
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> إضافة</button>

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
            //fetchOtherBranches(branchId);
            $('#qtyToAdd').val('');
            $('#qtyAfterAdd').val(0);
            $('#qtyBeforeAdd').val(0);


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

                $("#qtyBeforeAdd").val(data.amount);
                // $("#qtyToAdd").attr({"max" : data.amount });
            },
            error: function (data) {
                console.log(data);
            }
        });

        }



                $(document).ready(function () {

                    $("#qtyToAdd").bind('keyup mouseup', function () {
                    transQty = $('#qtyToAdd').val();
                    getQty = $('#qtyBeforeAdd').val();
                    calculate = parseInt(getQty) + parseInt(transQty);
                    $('#qtyAfterAdd').val(calculate);

                });

            });
            </script>

 @endsection
