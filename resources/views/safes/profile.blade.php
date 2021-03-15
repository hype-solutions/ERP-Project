@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/pages/page-users.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">

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
  <!-- users view media object start -->
  <div class="row">
    <div class="col-12 col-sm-7">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
                <li class="breadcrumb-item"><a href="{{route('safes.list')}}">الخزن</a></li>
                <li class="breadcrumb-item active">بيانات خزنة
                </li>
              </ol>
            </div>
          </div>
      <div class="media mb-2">
        <a class="mr-1" href="#">
          <img src="{{ asset('theme/app-assets/images/custom/safe.png') }}" alt="users view avatar"
            class="users-avatar-shadow rounded-circle" height="64" width="64">
        </a>
        <div class="media-body pt-25">
          <h4 class="media-heading"><span class="users-view-name">{{ $safe->safe_name }} </span>
            </h4>
          <span>رقم الخزنة:</span>
          <span class="users-view-id">
            <span class="badge badge-success users-view-status">{{ $safe->id }}</span>
        </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
       <div class="btn-group mr-1 mb-1">
        <button type="button" class="btn btn-warning btn-sm btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">التحكم السريع</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="{{ route('safes.transfer') }}"> تحويل رصيد</a>
            <a class="dropdown-item" href="{{ route('safes.deposit',$safe->id) }}"> إيداع</a>
            <a class="dropdown-item" href="{{ route('safes.withdraw',$safe->id) }}"> سحب</a>
            @if($safe->branch_id == 0)
            <div class="dropdown-divider"></div>
            <form action="{{route('safes.delete',$safe->id)}}" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذا الخزنة نهائيا و جميع تفاصيله من البرنامج')">
                @csrf
                @method('delete')
            <button class="dropdown-item btn-danger btn" type="submit">حذف الخزنة</button>
            </form>
            @endif
        </div>
    </div>

    </div>
  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        {{-- <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات الشراء: <span class="font-large-1 align-middle">125</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">عدد مرات عرض السعر: <span class="font-large-1 align-middle">534</span></h6>
            </div>
            <div class="col-12 col-sm-4 p-2">
              <h6 class="text-primary mb-0">إجمالي المبالغ من الفواتير: <span class="font-large-1 align-middle">256 ج.م</span></h6>
            </div>
          </div> --}}
        <div class="row">
          <div class="col-12 col-md-4">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td>اسم الخزنة:</td>
                  <td>{{ $safe->safe_name }}</td>
                </tr>

                <tr>
                  <td>مربوطة بفرع؟</td>
                  <td>
                      @if($safe->branch_id > 0)
                    نعم
                      @else
                        لا
                      @endif
                </td>
                </tr>
                @if($safe->branch_id > 0)
                <tr>
                  <td>الفرع المربوط:</td>
                <td><a href="{{route('branches.view',$safe->branch_id)}}" target="_blank">{{ $safe->branch->branch_name }}</a></td>
                </tr>
                @endif


              </tbody>
            </table>
          </div>
          <div class="col-xl-6 col-lg-12 mb-1">
            <div class="form-group text-center">
                <!-- Floating Outline button with text -->
            {{-- <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">{{ $safe->safe_balance }} ج.م</i><span>رصيد الخزنة</span></button> --}}
            <button type="button" class="btn btn-float btn-float-lg btn-outline-pink"><i class="">{{ $safe->safeBalance() }} ج.م</i><span>رصيد الخزنة</span></button>
             </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card data ends -->
  <!-- users view card details start -->





  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            {{-- <h4 class="card-title">Tab with Underline</h4> --}}
          </div>
          <div class="card-content">
            <div class="card-body">
              <ul class="nav nav-tabs nav-top-border no-hover-bg mb-3">
                <li class="nav-item">
                  <a class="nav-link active" id="active-tab32" data-toggle="tab" href="#active32" aria-controls="active32" aria-expanded="true">العمليات</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="link-tab32" data-toggle="tab" href="#link32" aria-controls="link32" aria-expanded="false">التحويلات</a>
                </li>
              </ul>
              <div class="tab-content px-1 pt-1">
                <div role="tabpanel" class="tab-pane active" id="active32" aria-labelledby="active-tab32" aria-expanded="true">
                  <div class="table-responsive">
                    <table class="table mb-0" id="transactions">
                        <thead>
                          <tr>
                            <th>رقم العملية</th>
                            <th>التاريخ</th>
                            <th>النوع </th>
                            <th>التفاصيل</th>
                            <th>المبلغ</th>
                            <th>الصلاحيات</th>
                             <th>التحكم</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($safeTransactions as $transaction)
                          <tr>
                            <td><div class="badge border-info info badge-border">
                                <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$transaction->id}}</span></a>
                            </div>
                          </td>
                          <td>{{$transaction->transaction_datetime}}</td>
                            <td>
                                  @if($transaction->transaction_type == 2)
                                  <div class="badge badge-success">
                                      <i class="la la-plus-circle font-medium-2"></i>
                                          <span>إيداع</span>
                                      </div>
                                  @else
                                  <div class="badge badge-danger">
                                      <i class="la la-minus-circle font-medium-2"></i>
                                          <span>سحب</span>
                                      </div>
                                  @endif
                              </td>
                            <td>
                              {{$transaction->transaction_notes}}
                            </td>
                            <td>{{$transaction->transaction_amount}} ج.م</td>
                            <td>
                              قام بالعملية
                              <div class="badge border-primary primary badge-border">
                                  <i class="la la-user font-medium-2"></i>
                                      <span>{{$transaction->done_user->username}}</span>
                                  </div>


                                <br>
                              صرح بالعملية
                              <div class="badge border-success success badge-square badge-border">
                                  <i class="la la-user font-medium-2"></i>
                                      <span>{{$transaction->auth_user->username}}</span>
                                  </div>
                            </td>

                            <td>
                                <button class="btn btn-success">استعراض</button>
                                <button class="btn btn-dark">طباعة</button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
                <div class="tab-pane" id="link32" role="tabpanel" aria-labelledby="link-tab32" aria-expanded="false">
                    <div class="table-responsive">
                        <table class="table mb-0" id="transfers">
                            <thead>
                              <tr>
                                <th>رقم العملية</th>
                                <th>التاريخ</th>
                                <th>من</th>
                                <th>الى</th>
                                <th>المبلغ</th>
                                <th>الصلاحيات</th>
                                <th>الملاحظات</th>
                                <th>التحكم</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($safeTransfers as $transfer)
                              <tr>
                                <td><div class="badge border-info info badge-border">
                                    <a href="#" target="_blank" style="color: #1e9ff2"><span>{{$transfer->id}}</span></a>
                                </div>
                              </td>
                                <td>{{$transfer->transfer_datetime}}</td>
                                <td>
                                    @if(isset($transfer->safeFrom))
                                      @if($transfer->safeFrom->id == $safe->id)
                                      <div class="badge badge-success">
                                          <i class="la la-flag font-medium-2"></i>
                                              <span>{{$transfer->safeFrom->safe_name}}</span>
                                          </div>
                                      @else
                                      <div class="badge badge-warning">
                                          <i class="la la-flag font-medium-2"></i>
                                              <span>{{$transfer->safeFrom->safe_name}}</span>
                                          </div>
                                      @endif
                                    @else
                                    <div class="badge badge-danger">
                                      <i class="la la-trash font-medium-2"></i>
                                          <span>{{str_replace('عملية تحويل رصيد خزنة بسبب حذفها - اسم الخزنة قبل الحذف','',$transfer->transfer_notes)}}</span>
                                      </div>
                                      <span style="color: red">(خزنة محذوفة)</span>
                                    @endif
                                      <hr>
                                        الرصيد قبل: {{$transfer->amount_before_transfer_from}} ج.م
                                        <br>
                                        الرصيد بعد: {{$transfer->amount_after_transfer_from}} ج.م
                                  </td>
                                <td>
                                  @if(isset($transfer->safeTo))
                                  @if($transfer->safeTo->id == $safe->id)
                                      <div class="badge badge-warning">
                                          <i class="la la-arrow-left font-medium-2"></i>
                                              <span>{{$transfer->safeTo->safe_name}}</span>
                                          </div>
                                      @else
                                      <div class="badge badge-success">
                                          <i class="la la-arrow-left font-medium-2"></i>
                                              <span>{{$transfer->safeTo->safe_name}}</span>
                                          </div>
                                      @endif
                                  @else
                                  <div class="badge badge-danger">
                                      <i class="la la-trash font-medium-2"></i>
                                          <span>{{str_replace('عملية تحويل رصيد خزنة بسبب حذفها - اسم الخزنة قبل الحذف','',$transfer->transfer_notes)}}</span>
                                      </div>
                                      <span style="color: red">(خزنة محذوفة)</span>                        @endif
                                  <hr>
                                        الرصيد قبل: {{$transfer->amount_before_transfer_to}} ج.م
                                        <br>
                                        الرصيد بعد: {{$transfer->amount_after_transfer_to}} ج.م
                              </td>
                                <td>{{$transfer->transfer_amount}} ج.م</td>
                                <td>
                                  قام بالتحويل
                                  <div class="badge border-primary primary badge-border">
                                      <i class="la la-user font-medium-2"></i>
                                          <span>{{$transfer->transferUser->username}}</span>
                                      </div>


                                    <br>
                                  صرح بالتحويل
                                  <div class="badge border-success success badge-square badge-border">
                                      <i class="la la-user font-medium-2"></i>
                                          <span>{{$transfer->authUser->username}}</span>
                                      </div>
                                </td>
                                <td>
                                  {{$transfer->transfer_notes}}
                                </td>
                                <td>
                                    <button class="btn btn-dark">طباعة</button>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>


  <!-- users view card details ends -->

</section>
<!-- users view ends -->
        </div>
      </div>



@include('common.footer')
@endsection


@section('pageJs')
<!-- BEGIN: Page Vendor JS-->

<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.print.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-print.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/jszip.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/pdfmake.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/vfs_fonts.js') }}"></script>
<script src="{{ asset('theme/app-assets/vendors/js/tables/buttons.html5.min.js') }}"></script>
<script>

$("#transactions").DataTable( {
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'عمليات خزنة: {{ $safe->safe_name }}',
                exportOptions: {
                    columns: [6,5,4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'عمليات خزنة: {{ $safe->safe_name }}',
                exportOptions: {
                    columns: [6,5,4,3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'عمليات خزنة: {{ $safe->safe_name }}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            }
        ]
    });

    $("#transfers").DataTable( {
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'حفظ كملف EXCEL',
                messageTop: 'تحويلات خزنة: {{ $safe->safe_name }}',
                exportOptions: {
                    columns: [6,5,4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'تحويلات خزنة: {{ $safe->safe_name }}',
                exportOptions: {
                    columns: [6,5,4,3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'تحويلات خزنة: {{ $safe->safe_name }}',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            }
        ]
    });
</script>


<!-- BEGIN: Theme JS-->



    <!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
{{-- <script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script> --}}
<!-- END: Page JS-->
@endsection
