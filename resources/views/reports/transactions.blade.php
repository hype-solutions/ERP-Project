@extends('layouts.erp')

@section('pageCss')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">

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
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">قائمة عمليات كل الخزن</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('reports.landing')}}">التقارير</a></li>
                <li class="breadcrumb-item active">عمليات الخزنة
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">



            </div>

          </div>
        </div>
      </div>
  <div class="content-body"><!-- users list start -->
    <section class="users-list-wrapper">

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
            @if(session()->get('success') == 'invoice deleted' )
        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>تم بنجاح!</strong> حذف بيانات عميل
        </div>

            @endif
        @endif
    {{-- <div class="users-list-filter px-1">
      <form>
          <div class="row border border-light rounded py-2 mb-2">
              <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-verified">Verified</label>
                  <fieldset class="form-group">
                      <select class="form-control" id="users-list-verified">
                          <option value="">Any</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-role">Role</label>
                  <fieldset class="form-group">
                      <select class="form-control" id="users-list-role">
                          <option value="">Any</option>
                          <option value="User">User</option>
                          <option value="Staff">Staff</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-status">Status</label>
                  <fieldset class="form-group">
                      <select class="form-control" id="users-list-status">
                          <option value="">Any</option>
                          <option value="Active">Active</option>
                          <option value="Close">Close</option>
                          <option value="Banned">Banned</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                  <button class="btn btn-block btn-primary glow">Show</button>
              </div>
          </div>
      </form>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{route('reports.transactions.search')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-md-4 ">
                                            <label>من</label>
                                            <input type="date" class="form-control" name="from" value="{{$fromX}}"/>
                                        </div>
                                        <div class="form-group col-md-4 ">
                                            <label>الى</label>
                                            <input type="date" class="form-control" name="to" value="{{$toX}}"/>
                                        </div>
                                        <div class="form-group col-md-4 ">
                                            <label  >الفرع</label>
                                            <select id="projectinput6" name="branch" class="form-control">
                                                <option value="{{$branch}}">تغيير الفرع</option>
                                                 @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="la la-check-square-o"></i> إستعراض
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                {{-- <div class="card-header"><h4>الملخص</h4></div> --}}
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>إجمالي الدواخل</td>
                                                <td>{{$safeTransactionsInSum}} ج.م</td>
                                            </tr>
                                            <tr>
                                                <td>إجمالي الخوارج</td>
                                                <td>{{$safeTransactionsOutSum}} ج.م</td>
                                            </tr>

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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header"><h4>العمليات</h4></div>
                    <div class="card-body">
                        <!-- datatable start -->
                        <div class="table-responsive">
                            <table class="table mb-0" id="transactions">
                                <thead>
                                  <tr>
                                    <th>رقم العملية</th>
                                    <th>الخزنة</th>
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
                                  <td>{{$transaction->safe->safe_name}}</td>
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
                                        <a href="{{ route('safes.receipt', $transaction->id) }}" target="_blank" class="btn btn-dark btn-sm"><i class="la la-folder-open"></i> استعراض</a>

                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                        <!-- datatable ends -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    </section>
    <!-- users list ends -->
      </div>
    </div>
    </div>
    <!-- END: Content-->
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
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [6,5,4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [6,5,4,3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6 ]
                }
            }
        ]
    });


</script><!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<!-- END: Page JS-->
@endsection
