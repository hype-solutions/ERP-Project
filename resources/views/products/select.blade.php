@extends('layouts.erp')
@section('title', 'عمليات على المنتجات')

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
    @if(session()->get('success') == 'product Added' )
<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>تم بنجاح!</strong> إضافة منتج جديد
</div>
    @endif
@endif
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('products.list')}}">المنتجات</a></li>
                <li class="breadcrumb-item active">عمليات على منتج
                </li>
              </ol>
            </div>
          </div>

    </div>

  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="card-text">
                {{-- <p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p> --}}
            </div>
              <form class="form" method="post" action="{{route('products.selecting')}}">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i> تحويل كميات بين الفروع</h4>
                    <input type="hidden" name="userChoise" value="1"/>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="text-bold-600 font-medium-2">إختر العملية</div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="userChoise" id="inlineRadio1" value="1" required>
                                <label class="form-check-label" for="inlineRadio1">تحويل كميات بين الفروع</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="userChoise" id="inlineRadio2" value="2" required>
                                <label class="form-check-label" for="inlineRadio2">إضافة كمية يدويا</label>
                              </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <br>

                        <div class="text-bold-600 font-medium-2">
                         إختر المنتج
                        </div>
                        <select class="select2-rtl form-control" data-placeholder="إختر المنتج..." name="product_id" required>
                            <option></option>
                            @foreach ($products as $item)
                            <option value="{{$item->id}}">{{$item->product_name}}</option>
                            @endforeach
                        </select>
                      </div>
                        </div>
                    </div>
                            <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> متابعه</button>
                        </form>
                </div>
            </div>
        </div>
  </div>
  <!-- users view card data ends -->

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
function trackBool() {
  var checkBox = document.getElementById("switcherySize10");
  // Get the output text
  var notifyWhen = document.getElementById("notify");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    notifyWhen.disabled  = false;
  } else {
    notifyWhen.disabled  = true;
    notifyWhen.value  = '';
  }
}

        $(document).ready(function () {

        $('#switcherySize10').change(function (e) {
            trackBool();

        });

    });
    </script>

 @endsection
