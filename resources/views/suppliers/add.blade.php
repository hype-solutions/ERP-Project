@extends('layouts.erp')
@section('title', 'إضافه مورد')


@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
<!-- END: Page CSS-->
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
    @if(session()->get('success') == 'Supplier Added' )
<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>تم بنجاح!</strong> إضافة مورد جديد
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
            <li class="breadcrumb-item"><a href="{{route('suppliers.list')}}">الموردين</a></li>
                <li class="breadcrumb-item active">إضافة مورد جديد
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
        <form class="form" method="post" action="{{route('suppliers.adding')}}">
                @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i> بيانات المورد</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">اسم المورد</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: علي محمد" name="supplier_name" required>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">الإيميل</label>
                                <div class="position-relative has-icon-left">
                                    <input type="email" id="timesheetinput2" class="form-control" placeholder="مثال: name@company.com" name="supplier_email">
                                    <div class="form-control-position">
                                        <i class="la la-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="timesheetinput2">الشركة</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="الشركة التي يمثلها" name="supplier_company">
                                    <div class="form-control-position">
                                        <i class="la la-home"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">الموبايل</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 01123456789" name="supplier_mobile" required>
                                    <div class="form-control-position">
                                        <i class="la la-mobile"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">التليفون</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" placeholder="مثال: 0223456789" name="supplier_phone">
                                    <div class="form-control-position">
                                        <i class="la la-phone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">السجل التجاري</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" name="supplier_commercial_registry">
                                    <div class="form-control-position">
                                        <i class="la la-institution"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">البطاقة الضريبية</label>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" name="supplier_tax_card">
                                    <div class="form-control-position">
                                        <i class="la la-legal"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="projectinput8">العنوان</label>
                        <div class="position-relative has-icon-left">
                        <textarea id="projectinput8" rows="3" class="form-control" name="supplier_address" placeholder="عنوان الشخص أو عنوان الشركة إن وجد"></textarea>
                        <div class="form-control-position">
                            <i class="la la-map"></i>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="projectinput8">الملاحظات</label>
                        <div class="position-relative has-icon-left">
                        <textarea id="projectinput8" rows="3" class="form-control" name="supplier_notes" placeholder="مثال: الأصناف المعروف بها هذا المورد"></textarea>
                        <div class="form-control-position">
                            <i class="la la-sticky-note"></i>
                        </div>
                        </div>
                    </div>
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i class="ft-x"></i> الغاء</button>
                            <button type="submit" class="btn btn-outline-primary"><i class="la la-check-square-o"></i> تسجيل</button>
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




<!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

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
