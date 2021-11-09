@extends('layouts.erp')
@section('title', 'إضافة دواخل')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

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
    @if(session()->get('success') == 'Branch Added' )
<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>تم بنجاح!</strong> إضافة فرع جديد
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
            <li class="breadcrumb-item"><a href="{{route('ins.list')}}">الدواخل</a></li>
                <li class="breadcrumb-item active">إضافة دواخل أخرى
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
        <form class="form" method="post" action="{{route('ins.adding')}}">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i> بيانات الدواخل</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="text-bold-500 font-medium-2">
                                البند
                                </div>
                                <select class="select2-rtl form-control" data-placeholder="إختر البند..." name="cat_id" id="cat_id" >
                                    <option></option>
                                    @foreach ($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="text-bold-500 font-medium-2">
                                الخزنة <span style="color:red">*</span>
                                </div>
                                <select class="select2-rtl form-control" data-placeholder="إختر الخزنة..." name="safe_id" id="safe_id"   required>
                                    <option></option>
                                    @foreach ($safes as $safe)
                                    <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">التاريخ</label>
                                <span style="color:red">*</span>

                                    <input type="date" value="{{date('Y-m-d')}}" id="timesheetinput2" class="form-control"  name="date" required>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">المبلغ</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control"   name="amount" required>
                                    <div class="form-control-position">
                                        <i class="la la-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="projectinput8">التفاصيل</label>
                        <div class="position-relative has-icon-left">
                        <textarea id="projectinput8" rows="3" class="form-control" name="notes" placeholder="تفاصيل الدخل"></textarea>
                        <div class="form-control-position">
                            <i class="la la-map"></i>
                        </div>
                        </div>
                    </div>
                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="la la-check-square-o"></i> تسجيل</button>
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

<!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {

        $('#solo').click(function () {
            $('#company_extra').hide();
            $('#company_extra2').hide();

        });
        $('#company').click(function () {
            $('#company_extra').show();
            $('#company_extra2').show();

        });
    });
    </script>

 @endsection
