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
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
        .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
        .tg .tg-dvpl{border-color:inherit;text-align:right;vertical-align:top}
        </style>
    <!-- END: Page CSS-->
@endsection

@section('content')
@include('common.header')
@include('common.mainmenu')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">التقارير</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">البرنامج</a></li>
            <li class="breadcrumb-item"><a href="{{route('reports.landing')}}">التقارير</a></li>
                <li class="breadcrumb-item active">التحكم
                </li>
              </ol>
            </div>
          </div>
        </div>

      </div>
  <div class="content-body"><!-- users list start -->

    <section id="hidden-label-form-layouts">
        <div class="row">

            <div class="col-md-6">
                <div class="card">

                    <div class="card-content collpase show">
                        <div class="card-body">


                            <form class="form" action="{{route('reports.landing')}}" method="GET">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-settings"></i> التحكم</h4>
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-2">
                                            <label>من</label>
                                            <input type="date" class="form-control" name="from" value="{{$fromX}}"/>
                                        </div>
                                        <div class="form-group col-md-6 mb-2">
                                            <label>الى</label>
                                            <input type="date" class="form-control" name="to" value="{{$toX}}"/>
                                        </div>
                                        <div class="form-group col-md-12 mb-2">
                                            <label class="sr-only" for="projectinput6">الفرع</label>
                                            <select id="projectinput6" name="branch" class="form-control">
                                                 @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-check-square-o"></i> إستعراض
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="row">
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="warning">{{$customersCount}}</h3>
                              <span>إجمالي عدد العملاء</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-users warning font-large-2 float-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6 col-12">
                    <div class="card">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="info">{{$suppliersCount}}</h3>
                              <span>إجمالي عدد الموردين</span>
                            </div>
                            <div class="align-self-center">
                              <i class="icon-social-dropbox info font-large-2 float-right"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-success">
                            <div class="card-content">
                              <div class="card-body">
                                <div class="media d-flex">
                                  <div class="align-self-center">
                                    <i class="icon-lock text-white font-large-2 float-left"></i>
                                  </div>
                                  <div class="media-body text-white text-center">
                                    <h2 class="text-white">{{$safesSum}} <small>ج.م</small></h2>
                                    <span>رصيد الخزنة / الخزن</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6">
                <div class="row">

                    <div class="col-xl-12 col-md-6 col-12 ">
                        <div class="card bg-success">
                            <div class="card-content">
                              <div class="card-body">
                                <div class="media d-flex">
                                  <div class="align-self-center">
                                    <i class="icon-lock text-white font-large-2 float-left"></i>
                                  </div>
                                  <div class="media-body text-white text-center">
                                    <h2 class="text-white">{{$safesSum}} <small>ج.م</small></h2>
                                    <span>رصيد الخزنة / الخزن</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                    </div>

                    <div class="col-xl-6 col-md-6 col-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="media-body text-left">
                                <h3 class="warning">{{$customersCount}}</h3>
                                <span>إجمالي عدد العملاء</span>
                              </div>
                              <div class="align-self-center">
                                <i class="icon-users warning font-large-2 float-right"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                      <div class="card">
                        <div class="card-content">
                          <div class="card-body">
                            <div class="media d-flex">
                              <div class="media-body text-left">
                                <h3 class="info">{{$suppliersCount}}</h3>
                                <span>إجمالي عدد الموردين</span>
                              </div>
                              <div class="align-self-center">
                                <i class="icon-social-dropbox info font-large-2 float-right"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div> --}}

            <div class="col-md-6">
                {{-- <div class="row">
                    <div class="col-xl-12 col-md-6 col-12 ">
                        <div class="card bg-success">
                            <div class="card-content">
                              <div class="card-body">
                                <div class="media d-flex">
                                  <div class="align-self-center">
                                    <i class="icon-lock text-white font-large-2 float-left"></i>
                                  </div>
                                  <div class="media-body text-white text-center">
                                    <h2 class="text-white">{{$safesSum}} <small>ج.م</small></h2>
                                    <span>رصيد الخزنة / الخزن</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                    </div>
                </div> --}}
                <div class="card">

                        <div class="table-responsive">
                            <table class="table mb-0 table-md">
                                <thead>
                                    <tr>
                                      <th colspan="2" class="text-center">ملخص المبيعات</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                    <tr class="bg-success white">
                                        <td scope="row">إجمالي المبيعات</td>
                                        <td>{{$posInvoicesSum + $invoicesSum + $invoicesSumLater}} ج.م</td>
                                      </tr>
                                      <tr class="bg-success white">
                                        <td scope="row">صافي ربح المبيعات</td>
                                        <td>{{$posInvoicesNet + $invoicesNet + $invoicesNetLater}} ج.م</td>
                                      </tr>
                                      <tr>
                                        <th colspan="2" class="text-center">ملخص المشاريع</th>
                                      </tr>
                                      <tr class="bg-success white">
                                        <td scope="row">إجمالي المشاريع</td>
                                        <td>{{$projectsSum}} ج.م</td>
                                      </tr>
                                      <tr class="bg-success white">
                                        <td scope="row">صافي ربح المشاريع</td>
                                        <td>{{$projectsNet}} ج.م</td>
                                      </tr>
                                      <tr>
                                        <th colspan="2" class="text-center">الدواخل</th>
                                      </tr>
                                      {{-- <tr class="bg-success white">
                                        <td scope="row">فواتير الدائن المحصلة</td>
                                        <td>{{$laterSumInv}} ج.م</td>
                                      </tr> --}}
                                      <tr class="bg-success white">
                                        <td scope="row">دواخل أخرى</td>
                                        <td>{{$income}} ج.م</td>
                                      </tr>
                                      <tr class="bg-success white">
                                        <td scope="row">الإيداعات بالخزنة</td>
                                        <td>{{$deposit}} ج.م</td>
                                      </tr>
                                      <tr>
                                        <th colspan="2" class="text-center">المصاريف</th>
                                      </tr>
                                      <tr class="bg-danger white">
                                        <td scope="row">مصاريف</td>
                                        <td>{{$expenses}} ج.م</td>
                                      </tr>
                                      <tr class="bg-danger white">
                                        <td scope="row">السحب من الخزنة</td>
                                        <td>{{$withdrawal}} ج.م</td>
                                      </tr>
                                      <tr class="bg-danger white">
                                        <td scope="row">فواتير الشراء (أوامر الشراء)</td>
                                        <td>{{$purchasesOrders}} ج.م</td>
                                      </tr>
                                      {{-- <tr class="bg-danger white">
                                        <td scope="row">فواتير المدين المدفوعة</td>
                                        <td>{{$laterSumPO}} ج.م</td>
                                      </tr> --}}

                                     <tr class="bg-info white">
                                        <th scope="row">إجمالي الدخل</th>
                                        <td>{{
                                                $posInvoicesSum +
                                                $invoicesSum +
                                                $projectsSum +
                                                $invoicesSumLater +
                                                $income +
                                                $deposit -
                                                $expenses -
                                                $withdrawal -
                                                $purchasesOrders
                                                }}
                                                 ج.م</td>

                                    </tr>
                                    <tr class="bg-info white">
                                        <th scope="row">الربح الصافي</th>
                                        <td>{{
                                                $posInvoicesNet +
                                                $invoicesNet +
                                                $invoicesNetLater +
                                                $projectsNet -
                                                $expenses
                                            }} ج.م</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="grouped-stats" class="grouped-stats">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-md-6 col-12 border-right-blue-grey border-right-lighten-5">
                    <div class="text-center">
                      <span class="font-large-1 text-bold-300 info">تقارير المبيعات</span>
                      <br/>
                      <br/>
                      <a href="{{route('reports.sales',[$fromX,$toX,$branch])}}" class="btn btn-info btn-block">التفاصيل</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12 border-right-blue-grey border-right-lighten-5">
                    <div class="text-center">
                      <span class="font-large-1 text-bold-300 warning">تقارير المشاريع</span>
                      <br/>
                      <br/>
                      <a href="{{route('reports.projects',[$fromX,$toX,$branch])}}" class="btn btn-warning btn-block">التفاصيل</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12 border-right-blue-grey border-right-lighten-5">
                    <div class="text-center">
                      <span class="font-large-1 text-bold-300 success">تقارير الدواخل</span>
                      <br/>
                      <br/>
                      <a href="{{route('reports.income',[$fromX,$toX,$branch])}}" class="btn btn-success btn-block">التفاصيل</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                    <div class="text-center">
                      <span class="font-large-1 text-bold-300  danger">تقارير المصاريف</span>
                      <br/>
                      <br/>
                      <a href="{{route('reports.expenses',[$fromX,$toX,$branch])}}" class="btn btn-danger btn-block">التفاصيل</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="row">
            <div class="col-6">
              <div class="card bg-gradient-x-success">
                <div class="card-content">
                  <div class="row">



                    <div class="col-lg-12 col-md-6 col-sm-12 card-gradient-md-border">
                      <div class="card-body text-center">
                        <h1 class="display-4 text-white">{{$laterSumInv}} <small>ج.م</small></h1>
                        <span class="text-white">أقساط الدائن المحصلة</span>
                        <br><br>
                        <a href="{{route('reports.invoicespayments',[$fromX,$toX,$branch])}}" class="btn btn-dark btn-block">التفاصيل</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="card bg-gradient-x-danger">
                <div class="card-content">
                  <div class="row">

                      <div class="col-lg-12 col-md-6 col-sm-12 card-gradient-md-border border-right-danger border-right-lighten-3">
                        <div class="card-body text-center">
                          <h1 class="display-4 text-white">{{$laterSumPO}} <small>ج.م</small></h1>
                          <span class="text-white">أقساط المدين المدفوعة</span>
                          <br><br>
                          <a href="{{route('reports.purchasesorderspayments',[$fromX,$toX,$branch])}}" class="btn btn-dark btn-block">التفاصيل</a>
                        </div>
                      </div>


                  </div>
                </div>
              </div>
            </div>
          </div>

    </section>

{{--

    <section id="grouped-stats" class="grouped-stats">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-content">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                      <div class="p-1 text-center">
                        <div>
                          <h3 class="display-4 blue-grey darken-1">{{$posInvoicesSum + $invoicesSum}} <small>ج.م</small></h3>
                          <span class="blue-grey darken-1">المبيعات</span>
                        </div>
                        <div class="card-content">
                          <ul class="list-inline clearfix">
                            <li class="border-right-blue-grey border-right-lighten-2 pr-1">
                              <h1 class="danger text-bold-400">{{$posInvoicesCount + $invoicesCount}}</h1>
                              <span class="blue-grey darken-1"><i class="la la-caret-up"></i> عدد الفواتير</span>
                            </li>
                            <li class="pl-1">
                              <h1 class="success text-bold-400">{{$posInvoicesDone + $invoicesDone}}</h1>
                              <span class="blue-grey darken-1"><i class="la la-caret-down"></i> منتهية</span>
                            </li>
                          </ul>
                          <button class="btn btn-info btn-block">إستعراض التفاصيل</button>
                        </div>
                      </div>
                    </div>
                     <div class="col-lg-3 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                      <div class="p-1 text-center">
                        <div>
                          <h3 class="display-4 blue-grey darken-1">{{$invoicesSum}} <small>ج.م</small></h3>
                          <span class="blue-grey darken-1">فواتير مبيعات</span>
                        </div>
                        <div class="card-content">
                          <ul class="list-inline clearfix">
                            <li class="border-right-blue-grey border-right-lighten-2 pr-1">
                              <h1 class="danger text-bold-400">{{$invoicesCount}}</h1>
                              <span class="blue-grey darken-1"><i class="la la-caret-up"></i> عدد الفواتير</span>
                            </li>
                            <li class="pl-1">
                              <h1 class="success text-bold-400">{{$invoicesDone}}</h1>
                              <span class="blue-grey darken-1"><i class="la la-caret-down"></i> منتهية</span>
                            </li>
                          </ul>
                          <button class="btn btn-info btn-block">إستعراض التفاصيل</button>
                        </div>
                      </div>
                    </div>
                     <div class="col-lg-3 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                      <div class="p-1 text-center">
                        <div>
                          <h3 class="display-4 blue-grey darken-1">{{$invoicesPriceQuotationsSum}} <small>ج.م</small></h3>
                          <span class="blue-grey darken-1">عروض الأسعار</span>
                        </div>
                        <div class="card-content">
                          <ul class="list-inline clearfix">
                            <li class="border-right-blue-grey   border-right-lighten-2 pr-1">
                              <h1 class="danger text-bold-400">{{$invoicesPriceQuotationsCount}}</h1>
                              <span class="blue-grey darken-1"><i class="la la-caret-up"></i> عدد العروض</span>
                            </li>
                            <li class="pl-1">
                              <h1 class="success text-bold-400">0</h1>
                              <span class="blue-grey darken-1"><i class="la la-caret-down"></i> مصدقة</span>
                            </li>
                          </ul>
                          <button class="btn btn-info btn-block">إستعراض التفاصيل</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 border-right-blue-grey border-right-lighten-5">
                        <div class="p-1 text-center">
                          <div>
                            <h3 class="display-4 blue-grey darken-1">{{$projectsSum}} <small>ج.م</small></h3>
                            <span class="blue-grey darken-1">المشاريع</span>
                          </div>
                          <div class="card-content">
                            <ul class="list-inline clearfix">
                              <li class="border-right-blue-grey   border-right-lighten-2 pr-1">
                                <h1 class="danger text-bold-400">{{$projectsCount}}</h1>
                                <span class="blue-grey darken-1"><i class="la la-caret-up"></i> عدد المشاريع</span>
                              </li>
                              <li class="pl-1">
                                <h1 class="success text-bold-400">0</h1>
                                <span class="blue-grey darken-1"><i class="la la-caret-down"></i> منتهية</span>
                              </li>
                            </ul>
                            <button class="btn btn-info btn-block">إستعراض التفاصيل</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section> --}}

<!-- users list ends -->
  </div>
</div>
</div>
<!-- END: Content-->
@include('common.footer')
@endsection


@section('pageJs')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

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
<script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>
<script src="{{ asset('theme/app-assets/js/scripts/cards/card-statistics.min.js') }}"></script>

<script>

$("#list").DataTable( {
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
                    columns: [4,3,2,1,0 ]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'حفظ كملف PDF',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [4,3,2,1,0 ]
                },

            },
            {
                extend: 'print',
                text: 'طباعة',
                messageTop: 'سجل عمليات الخزن',
                exportOptions: {
                    columns: [ 0,1,2,3,4 ]
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
<script src="{{ asset('theme/app-assets/js/scripts/pages/page-users.min.js') }}"></script>
<!-- END: Page JS-->
@endsection
