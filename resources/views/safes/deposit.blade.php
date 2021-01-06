@extends('layouts.erp')

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
    @if(session()->get('success') == 'deposited' )
<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>تم بنجاح!</strong> تسجيل عملية ايداع
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
            <li class="breadcrumb-item"><a href="{{route('safes.list')}}">الخزن</a></li>
                <li class="breadcrumb-item active">ايداع
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
        <form class="form" method="post" action="{{route('safes.depositing')}}">
                @csrf
                <input type="hidden" name="safe_id" value="{{$safe->id}}" />
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i> عملية إيداع</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">الخزنة</label>
                                <span style="color:red">*</span>
                                <div class="position-relative has-icon-left">
                                    <input type="text" id="timesheetinput2" class="form-control" value="{{$safe->safe_name}}" name="safe_name" required readonly>
                                    <div class="form-control-position">
                                        <i class="la la-home"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="timesheetinput2">المبلغ</label>
                                <div class="position-relative has-icon-left">
                                    <input type="number" id="timesheetinput2" class="form-control"  name="amount" required>
                                    <div class="form-control-position">
                                        <i class="la la-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="projectinput8">تفاصيل الإيداع</label>
                        <div class="position-relative has-icon-left">
                        <textarea id="projectinput8" rows="3" class="form-control" name="notes"></textarea>
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
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
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
