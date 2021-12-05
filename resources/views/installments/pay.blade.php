@extends('layouts.erp')
@section('title', 'تسديد قسط')

@section('pageCss')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users view start -->
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

                @if (session()->has('success'))
                    @if (session()->get('success') == 'Branch Added')
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
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('installments.landing') }}">الاقساط</a>
                                    </li>
                                    <li class="breadcrumb-item active">تسديد قسط
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
                            @if ($type == 1)
                                <form class="form" method="post" action="{{ route('installments.paying') }}">
                                    <input type="hidden" name="installment_invoice" value="{{ $ins->id }}" />
                                    @csrf
                                    <input type="hidden" name="installment_type" value="invoice">
                                    <div class="form-body">
                                        <h4 class="form-section">
                                            <i class="ft-user"></i>
                                            تسديد قسط خاص بفاتورة مبيعات
                                        </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput3">إختر
                                                        الخزنة</label>
                                                    <select class="select2-rtl form-control"
                                                        data-placeholder="إختر الخزنة..." name="safe_id" required>
                                                        <option>
                                                        </option>
                                                        @foreach ($safes as $safe)
                                                            <option value="{{ $safe->id }}">
                                                                {{ $safe->safe_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="timesheetinput2">المبلغ</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="number" id="timesheetinput2" class="form-control"
                                                            name="amount" value="{{ $ins->amount }}" required readonly>
                                                        <div class="form-control-position">
                                                            <i class="la la-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="projectinput8">تفاصيل
                                                الإيداع</label>
                                            <div class="position-relative has-icon-left">
                                                <textarea id="projectinput8" rows="3" class="form-control" name="notes"
                                                    readonly>قسط على فاتورة رقم {{ $ins->invoice_id }}</textarea>
                                                <div class="form-control-position">
                                                    <i class="la la-sticky-note"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i
                                                class="ft-x"></i>
                                            الغاء</button>
                                        <button type="submit" class="btn btn-outline-primary"><i
                                                class="la la-check-square-o"></i>
                                            تسجيل</button>
                                </form>
                            @elseif($type == 2)
                                <form class="form" method="post" action="{{ route('installments.paying') }}">
                                    <input type="hidden" name="installment_invoice" value="{{ $ins->id }}" />
                                    @csrf
                                    <input type="hidden" name="installment_type" value="po">
                                    <div class="form-body">
                                        <h4 class="form-section">
                                            <i class="ft-user"></i>
                                            تسديد دفعه على أمر شراء
                                        </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput3">إختر
                                                        الخزنة</label>
                                                    <select class="select2-rtl form-control"
                                                        data-placeholder="إختر الخزنة..." name="safe_id" required>
                                                        <option>
                                                        </option>
                                                        @foreach ($safes as $safe)
                                                            <option value="{{ $safe->id }}">
                                                                {{ $safe->safe_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="timesheetinput2">المبلغ</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="number" id="timesheetinput2" class="form-control"
                                                            name="amount" value="{{ $ins->amount }}" required readonly>
                                                        <div class="form-control-position">
                                                            <i class="la la-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="projectinput8">تفاصيل
                                                العملية</label>
                                            <div class="position-relative has-icon-left">
                                                <textarea id="projectinput8" rows="3" class="form-control" name="notes"
                                                    readonly>تسديد دفعه على أمر شراء {{ $ins->purchase_id }}
                                                </textarea>
                                                <div class="form-control-position">
                                                    <i class="la la-sticky-note"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i
                                                class="ft-x"></i>
                                            الغاء</button>
                                        <button type="submit" class="btn btn-outline-primary"><i
                                                class="la la-check-square-o"></i>
                                            تسجيل</button>
                                </form>
                            @elseif($type == 3)
                                <form class="form" method="post" action="{{ route('installments.paying') }}">
                                    <input type="hidden" name="installment_invoice" value="{{ $ins->id }}" />
                                    @csrf
                                    <input type="hidden" name="installment_type" value="external">
                                    <div class="form-body">
                                        <h4 class="form-section">
                                            <i class="ft-user"></i>
                                            تسديد تمويل خارجي
                                        </h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="projectinput3">إختر
                                                        الخزنة</label>
                                                    <select class="select2-rtl form-control"
                                                        data-placeholder="إختر الخزنة..." name="safe_id" required>
                                                        <option>
                                                        </option>
                                                        @foreach ($safes as $safe)
                                                            <option value="{{ $safe->id }}">
                                                                {{ $safe->safe_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="timesheetinput2">المبلغ</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="number" id="timesheetinput2" class="form-control"
                                                            name="amount" value="{{ $ins->amount }}" required readonly>
                                                        <div class="form-control-position">
                                                            <i class="la la-money"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="projectinput8">تفاصيل
                                                العملية</label>
                                            <div class="position-relative has-icon-left">
                                                <textarea id="projectinput8" rows="3" class="form-control" name="notes"
                                                    readonly>تسديد تمويل خارجي رقم {{ $ins->id }} لصالح المستثمر {{ $ins->investor }}
                                                </textarea>
                                                <div class="form-control-position">
                                                    <i class="la la-sticky-note"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"><i
                                                class="ft-x"></i>
                                            الغاء</button>
                                        <button type="submit" class="btn btn-outline-primary"><i
                                                class="la la-check-square-o"></i>
                                            تسجيل</button>
                                </form>
                            @endif
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
        $(document).ready(function() {

            $('#solo').click(function() {
                $('#company_extra').hide();
                $('#company_extra2').hide();

            });
            $('#company').click(function() {
                $('#company_extra').show();
                $('#company_extra2').show();

            });
        });
    </script>

@endsection
