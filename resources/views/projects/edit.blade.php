@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/wizard.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/pickers/daterange/daterange.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/forms/selects/select2.min.css') }}">

<style>
    .product_input{
    width: 100%;
    padding: 0 4px;
    overflow: hidden;
    line-height: 17px;
    height: 40px;
    resize: none;
    background: 0 0;
    margin: 0;
    font-size: 12px;
    border:none;
    }
    .product_sel{
        margin-bottom: 0 !important;
    }
    #myTable tr td{
  padding: 0 !important;
  margin: 0 !important;
}
</style>

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
    @if(session()->get('success') == 'project Added' )
<div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <strong>تم بنجاح!</strong> إضافة عميل جديد
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
            <li class="breadcrumb-item"><a href="{{route('projects.list')}}">المشروعات</a></li>
                <li class="breadcrumb-item active">إضافة مشروع جديد
                </li>
              </ol>
            </div>
          </div>

    </div>

  </div>
  <!-- users view media object ends -->
  <!-- users view card data start -->
  <section id="icon-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form action="{{ route('projects.update',$project) }}" method="POST" class="icons-tab-steps wizard-notification" id="mashroo3">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="created_by" value="{{ $user_id }}" />
                            <input type="hidden" name="total" id="totalToSave" value="0" />
                            <input type="hidden" name="step" id="theStep" value="{{$project->step}}" />
                            <!-- Step 1 -->
                            <h6><i class="step-icon la la-eye"></i> بيانات المشروع</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName2">اسم المشروع:</label>
                                            <input type="text" class="form-control" id="firstName2" name="project_name" value="{{$project->project_name}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="text-bold-600 font-medium-2">
                                             المستفيد:
                                            </div>
                                            <select class="select2-rtl form-control" data-placeholder="إختر العميل..." name="customer_id"   required>
                                                <option value="{{$project->customer_id}}">{{$project->customer->customer_name}}</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date2">تاريخ بداية المشروع:</label>
                                            <input type="date" class="form-control" id="date2" name="project_start_date" value="{{$project->project_start_date}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date2">موعد استحقاق المشروع:</label>
                                            <input type="date" class="form-control" id="date2" name="project_end_date" value="{{$project->project_end_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="button" onclick="stepsWizard.steps('next')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">التالي</a>
                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ</button>
                                </div>
                            </fieldset>

                            <!-- Step 1 -->
                            <h6><i class="step-icon la la-eye"></i> المعاينة</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>أرفق ملفات المعاينة</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFile02">اختر الملف </label>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        @if($previewFiles->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الملف</th>
                                                        <th>نوع الملف</th>
                                                        <th>التحكم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($previewFiles as $key2 => $item)
                                                    <tr>
                                                        <th scope="row">{{++$key2}}</th>
                                                        <td>{{$item->file_name}}</td>
                                                        <td>{{$item->file_ext}}</td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm">استعراض</button>
                                                            <button class="btn btn-danger btn-sm">حذف</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p class="text-center text-danger mt-3">لا توجد ملفات مرفوعه</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="" class="form-control" id="" cols="5" rows="10" placeholder="تفاصيل المعاينة"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    @if($project->step == 1)
                                    <button type="button" onclick="return updateProj(1)" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">الإنتقال الى عرض السعر</button>
                                    @else
                                    <button type="button" onclick="stepsWizard.steps('next')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">التالي</a>
                                    @endif
                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ و عودة لاحقا</button>
                                </div>
                            </fieldset>

                            <!-- Step 2 -->
                            <h6><i class="step-icon la la-th-list"></i>عرض السعر</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-content collapse show">
                                                <div class="card-body">

                                                    <div class="form-group">
                                                        <!-- Outline Buttons Glow -->
                                                        <button type="button" class="btn btn-outline-info btn-min-width btn-glow mr-1 mb-1">طباعة</button>
                                                        <button type="button" class="btn btn-outline-warning btn-min-width btn-glow mr-1 mb-1">ارسال بالبريد</button>
                                                    </div>

                                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                                        <li class="nav-item">
                                                          <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11" href="#tab11" aria-expanded="true">الخصم</a>
                                                        </li>
                                                        <li class="nav-item">
                                                          <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13" aria-expanded="false">الشحن</a>
                                                        </li>
                                                      </ul>
                                                      <div class="tab-content px-1 pt-1">
                                                          <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
                                                           <div class="row">
                                                                <div class="col-md-4"  id="dis_per">
                                                                    <div class="form-group">
                                                                        <label for="projectinput3">الخصم</label>
                                                                        <input type="number" id="curr_per" class="form-control" placeholder="" name="discount_percentage" value="{{$project->discount_percentage}}" min="0" max="100" onblur="return calculateDiscount(1)">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4" style="display: none" id="dis_amount">
                                                                  <div class="form-group">
                                                                      <label for="projectinput3">الخصم</label>
                                                                      <input type="number" id="curr_amount" class="form-control" placeholder="" name="discount_amount" value="{{$project->discount_amount}}" min="0" onblur="return calculateDiscount(2)">
                                                                  </div>
                                                              </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="projectinput3">النوع</label>

                                                                        <select class="form-control" onchange="return changeDisType(this)">
                                                                            <option value="percent">نسبة مئوية (%)</option>
                                                                            <option value="fixed">المبلغ</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="projectinput3">مصاريف الشحن</label>
                                                                        <input type="number" id="shipping_fees" class="form-control" placeholder="" name="shipping_fees" value="{{$project->shipping_fees}}" onblur="return updateShipping()" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                      </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered" id="myTable" style="overflow: hidden;">
                                                <thead class="bg-yellow bg-lighten-4">
                                                    <tr>
                                                        <th style="width: 250px">البند</th>
                                                            <span class="tooltip">
                                                                <a href="#" tabindex="-1"><img src="/css/images/question-ar.png" class="tips-image"></a>
                                                            </span>
                                                        </th>
                                                        <th>سعر الوحدة</th>
                                                        <th>الكمية</th>
                                                        <th>المجموع</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                     $key = 0;
                                                    @endphp
                                                    @foreach ($priceQuotation as $key => $item)
                                                    <tr id="row_{{$key+1}}">

                                                        <td><input type="text" class="product_input" name="product[{{$key+1}}][desc]" value="{{$item->product_desc}}"/></td>
                                                        <td><input type="number" class="product_input" id="p_p_{{$key+1}}" name="product[{{$key+1}}][price]" value="{{$item->product_price}}" onblur="return reCalculate({{$key+1}})" min="0"/></td>
                                                        <td><input type="number" class="product_input" id="p_q_{{$key+1}}" name="product[{{$key+1}}][qty]" value="{{$item->product_qty}}" onblur="return reCalculate({{$key+1}})" min="0" placeholder="0"/></td>
                                                        <td>
                                                            <span id="tot_{{$key+1}}">0</span> ج.م
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="2" style="border-style: none !important;">
                                                            <div>
                                                                <button type="button" onclick="addField()" class="add-row btn m-b-xs btn-sm btn-success btn-addon btn-blue" id="addingRowBtn">
                                                                    <i class="la la-plus"></i>
                                                                    إضافة بند
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td colspan="2" class="text-right"  style="border-style: none !important;"><strong>الإجمالي</strong></td>
                                                        <td class="text-left"  style="border-style: none !important;"><code><span id="total_after_all">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr id="hidden-row-1" style="display: none">
                                                        <td colspan="4" class="text-right"><strong> الخصم (النسبة)[<span id="discount_percentage" style="color: goldenrod">0</span>%]</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span id="discount_percentage_amount">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                     </tr>
                                                     <tr id="hidden-row-2" style="display: none">
                                                        <td colspan="4" class="text-right"><strong>الخصم (المبلغ)</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span id="discount_amount">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                     </tr>
                                                     <tr id="hidden-row-3" style="display: none">
                                                        <td colspan="4" class="text-right"><strong>الشحن</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span id="shipping">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                     </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><strong>الإجمالي</strong></td>
                                                        <td id="TotalValue" class="text-left"><code><span id="total_after_all2">0</span></code>&nbsp;ج.م</td>
                                                        <td></td>
                                                     </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>

                                <div class="form-group mt-3">
                                    @if($project->step == 2)
                                    <button type="button" onclick="return updateProj(2)" class="btn mb-1 btn-danger btn-lg btn-glow" style="float: left">رفض</button>
                                    <button type="button" onclick="return updateProj(2)" class="btn mb-1 btn-success btn-lg btn-glow" style="float: left">تصديق على عرض السعر</button>
                                    @else
                                    <button type="button" onclick="stepsWizard.steps('next')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">التالي</a>
                                    @endif

                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ</button>
                                </div>
                            </fieldset>

                            <!-- Step 3 -->
                            <h6><i class="step-icon la la-list-alt"></i>بنود العقد</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>أرفق بنود العقد</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFile02">اختر الملف </label>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        @if($contractFiles->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الملف</th>
                                                        <th>نوع الملف</th>
                                                        <th>التحكم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($contractFiles as $key3 => $item)
                                                    <tr>
                                                        <th scope="row">{{++$key3}}</th>
                                                        <td>{{$item->file_name}}</td>
                                                        <td>{{$item->file_ext}}</td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm">استعراض</button>
                                                            <button class="btn btn-danger btn-sm">حذف</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p class="text-center text-danger mt-3">لا توجد ملفات مرفوعه</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    @if($project->step == 3)
                                    <button type="button" onclick="return updateProj(3)" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">الإنتقال للدفعات</button>
                                    @else
                                    <button type="button" onclick="stepsWizard.steps('next')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">التالي</a>
                                    @endif
                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ و عودة لاحقا</button>
                                </div>

                            </fieldset>

                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-money"></i>الدفعات</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div >
                                            <h4 class="form-section"><i class="la la-flag"></i> الدفعات <button onclick="addDofaa()" type="button" class="btn btn-success btn-sm"><i class="la la-plus"></i></button></h4>
                                            <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="dofaaTable">
                                                <thead>
                                                    <tr>
                                                        <th>المبلغ</th>
                                                        <th>تاريخ الإستحقاق</th>
                                                        <th>تم دفعها؟</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-group">
                                                                <input type="number" id="" class="form-control" placeholder="أدخل المبلغ" name="later[1][amount]" value="0">
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <fieldset class="form-group">
                                                            <input type="date" class="form-control" id="date" value="2020-08-19" name="later[1][date]">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <div class="labrl">الملاحظات</div>
                                                            <textarea class="form-control" id="placeTextarea" rows="3" placeholder="مثال: الدفعه المقدمة" name="later[1][notes]"></textarea>
                                                        </fieldset>
                                                    </td>

                                                        <td>
                                                            {{-- <fieldset class="checkboxsas">
                                                                <label>
                                                                    مدفوعه مسبقا
                                                                  <input type="checkbox" name="later[1][paid]"  onchange="return laterPaid(1)">
                                                                </label>
                                                            </fieldset> --}}
                                                            <fieldset class="checkboxsas">
                                                                <label>
                                                                    دفع الان
                                                                  <input type="checkbox" name="later[1][paynow]">
                                                                </label>
                                                            </fieldset>
                                                            {{-- <div id="later_dates_1" style="display:none;">
                                                            <div class="form-group">
                                                                <div class="label">رقم العملية في الخزنة:</div>
                                                                <input type="text" id="" class="form-control" placeholder="رقم العملية في الخزنة" name="later[1][safe_payment_id]">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="projectinput3">الخزنة:</label>
                                                                <select class="select2-rtl form-control" data-placeholder="تعديل" name="later[1][safe_id]">
                                                                    <option></option>
                                                                    @foreach ($safes as $safe)
                                                                    <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            </div> --}}
                                                            {{-- <div id="pay_now_1" style="display:none;">
                                                                <div class="form-group">
                                                                    <label for="projectinput3">توريد:</label>
                                                                    <select class="select2-rtl form-control" data-placeholder="تعديل" name="later[1][safe_id]">
                                                                        <option></option>
                                                                        @foreach ($safes as $safe)
                                                                        <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                </div> --}}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                                <div class="form-group mt-3">
                                    @if($project->step == 4)
                                    <button type="button" onclick="return updateProj(4)" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">الإنتقال لفواتير المشتريات</button>
                                    @else
                                    <button type="button" onclick="stepsWizard.steps('next')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">التالي</a>
                                    @endif
                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ و عودة لاحقا</button>
                                </div>
                            </fieldset>
                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-files-o"></i>فواتير المشتريات</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn mb-1 btn-success btn-icon btn-lg btn-block" data-toggle="modal" data-target="#xlarge">
                                                <i class="la la-plus-circle"></i>
                                                أضف فاتورة جديدة
                                            </button>
                                            <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel16">Basic Modal</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Check First Paragraph</h5>
                                                            <p>Oat cake ice cream candy chocolate cake chocolate cake cotton candy dragée apple pie. Brownie carrot
                                                                cake candy canes bonbon fruitcake topping halvah. Cake sweet roll cake cheesecake cookie chocolate cake
                                                                liquorice. Apple pie sugar plum powder donut soufflé.</p>
                                                            <p>Sweet roll biscuit donut cake gingerbread. Chocolate cupcake chocolate bar ice cream. Danish candy
                                                                cake.</p>
                                                            <hr>
                                                            <h5>Some More Text</h5>
                                                            <p>Cupcake sugar plum dessert tart powder chocolate fruitcake jelly. Tootsie roll bonbon toffee danish.
                                                                Biscuit sweet cake gummies danish. Tootsie roll cotton candy tiramisu lollipop candy cookie biscuit pie.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-outline-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>تاريخ الفاتورة</th>
                                                        <th>إجمالي الفاتورة</th>
                                                        <th>التحكم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>03/04/2021</td>
                                                        <td>5698 ج.م</td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm">استعراض</button>
                                                            <button class="btn btn-danger btn-sm">حذف</button>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    @if($project->step == 5)
                                    <button type="button" onclick="return updateProj(5)" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">الإنتقال للملحقات</button>
                                    @else
                                    <button type="button" onclick="stepsWizard.steps('next')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">التالي</a>
                                    @endif
                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ و عودة لاحقا</button>
                                </div>
                            </fieldset>
                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-link"></i>الملحقات</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label>أرفق ملف ملحق</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFile02">اختر الملف </label>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        @if($attachmentFiles->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الملف</th>
                                                        <th>نوع الملف</th>
                                                        <th>التحكم</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($attachmentFiles as $key4 => $item)
                                                    <tr>
                                                        <th scope="row">{{++$key4}}</th>
                                                        <td>{{$item->file_name}}</td>
                                                        <td>{{$item->file_ext}}</td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm">استعراض</button>
                                                            <button class="btn btn-danger btn-sm">حذف</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @else
                                        <p class="text-center text-danger mt-3">لا توجد ملفات مرفوعه</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    @if($project->step == 6)
                                    <button type="button" onclick="return updateProj(6)" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">إنهاء المشروع</button>
                                    @else
                                    <button type="button" onclick="stepsWizard.steps('prev')" class="btn mb-1 btn-secondary btn-lg btn-glow" style="float: left">السابق</a>
                                    @endif
                                    <button type="submit" class="btn mb-1 btn-primary btn-lg btn-glow" style="float: left">حفظ و عودة لاحقا</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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

<script src="{{ asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script src="{{ asset('theme/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Theme JS-->



<script>


function updateProj(oldStep){
    $('#theStep').val(oldStep+1);
    $('#mashroo3').submit();
}






    var nextAllowed = $('#theStep').val();
    nextAllowed = parseInt(nextAllowed);
    if(nextAllowed == 7){
        nextAllowed = 6;
    }
    stepsWizard  = $(".icons-tab-steps").steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    enableKeyNavigation: false,
    enablePagination: false,
    labels: {
        finish: "حفظ"
    },
    saveState: true,
    startIndex: nextAllowed,
    onStepChanging: function(event, currentIndex, newIndex)
    {
        if (newIndex < currentIndex) return true;
        if (newIndex > currentIndex){
            // if(nextAllowed <= newIndex){
            if(newIndex <= nextAllowed){
                return true;
            }
        }
        // if(currentIndex == 0){
        //     if(nextAllowed == 1){
        //         return true;
        //      }else{
        //          alert('أكمل البيانات');
        //          return false;
        //          }
        // }
    },
    onFinished: function (e, t) {
        alert("Form submitted.")
    }
})
</script>

    {{-- <script src="{{ asset('theme/app-assets/js/scripts/forms/wizard-steps.min.js') }}"></script> --}}
    <script src="{{ asset('theme/app-assets/js/scripts/forms/custom-file-input.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js') }}"></script>


 @endsection
