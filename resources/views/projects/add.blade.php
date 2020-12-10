@extends('layouts.erp')

@section('pageCss')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/menu/menu-types/vertical-compact-menu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/core/colors/palette-gradient.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/fonts/mobiriseicons/24px/mobirise/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/forms/wizard.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/plugins/pickers/daterange/daterange.min.css') }}">



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
                        <form action="#" class="icons-tab-steps wizard-notification">

                            <!-- Step 1 -->
                            <h6><i class="step-icon la la-eye"></i> المعاينة</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName2">First Name :</label>
                                            <input type="text" class="form-control" id="firstName2">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastName2">Last Name :</label>
                                            <input type="text" class="form-control" id="lastName2">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailAddress3">Email Address :</label>
                                            <input type="email" class="form-control" id="emailAddress3">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location2">Select City :</label>
                                            <select class="c-select form-control" id="location2" name="location">
                                                <option value="">Select City</option>
                                                <option value="Amsterdam">Amsterdam</option>
                                                <option value="Berlin">Berlin</option>
                                                <option value="Frankfurt">Frankfurt</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phoneNumber2">Phone Number :</label>
                                            <input type="tel" class="form-control" id="phoneNumber2">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date2">Date of Birth :</label>
                                            <input type="date" class="form-control" id="date2">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Step 2 -->
                            <h6><i class="step-icon la la-th-list"></i>عرض السعر</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proposalTitle2">Proposal Title :</label>
                                            <input type="text" class="form-control" id="proposalTitle2">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress4">Email Address :</label>
                                            <input type="email" class="form-control" id="emailAddress4">
                                        </div>
                                        <div class="form-group">
                                            <label for="videoUrl2">Video URL :</label>
                                            <input type="url" class="form-control" id="videoUrl2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jobTitle2">Job Title :</label>
                                            <input type="text" class="form-control" id="jobTitle2">
                                        </div>
                                        <div class="form-group">
                                            <label for="shortDescription2">Short Description :</label>
                                            <textarea name="shortDescription" id="shortDescription2" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Step 3 -->
                            <h6><i class="step-icon la la-list-alt"></i>بنود العقد</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="eventName2">Event Name :</label>
                                            <input type="text" class="form-control" id="eventName2">
                                        </div>
                                        <div class="form-group">
                                            <label for="eventType2">Event Type :</label>
                                            <select class="c-select form-control" id="eventType2" data-placeholder="Type to search cities"
                                                name="eventType2">
                                                <option value="Banquet">Banquet</option>
                                                <option value="Fund Raiser">Fund Raiser</option>
                                                <option value="Dinner Party">Dinner Party</option>
                                                <option value="Wedding">Wedding</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="eventLocation2">Event Location :</label>
                                            <select class="c-select form-control" id="eventLocation2" name="location">
                                                <option value="">Select City</option>
                                                <option value="Amsterdam">Amsterdam</option>
                                                <option value="Berlin">Berlin</option>
                                                <option value="Frankfurt">Frankfurt</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Date - Time :</label>
                                            <div class='input-group'>
                                                <input type='text' class="form-control datetime" />
                                                <span class="input-group-addon">
                                                    <span class="ft-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="eventStatus2">Event Status :</label>
                                            <select class="c-select form-control" id="eventStatus2" name="eventStatus">
                                                <option value="Planning">Planning</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Finished">Finished</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Requirements :</label>
                                            <div class="c-inputs-stacked">
                                                <div class="d-inline-block custom-control custom-checkbox">
                                                    <input type="checkbox" name="status2" class="custom-control-input"
                                                        id="staffing2">
                                                    <label class="custom-control-label" for="staffing2">Staffing</label>
                                                </div>
                                                <div class="d-inline-block custom-control custom-checkbox">
                                                    <input type="checkbox" name="status2" class="custom-control-input"
                                                        id="catering2">
                                                    <label class="custom-control-label" for="catering2">Catering</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-calendar-check-o"></i>موعد استحقاق المشروع</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meetingName2">Name of Meeting :</label>
                                            <input type="text" class="form-control" id="meetingName2">
                                        </div>

                                        <div class="form-group">
                                            <label for="meetingLocation2">Location :</label>
                                            <input type="text" class="form-control" id="meetingLocation2">
                                        </div>

                                        <div class="form-group">
                                            <label for="participants2">Names of Participants</label>
                                            <textarea name="participants" id="participants2" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="decisions2">Decisions Reached</label>
                                            <textarea name="decisions" id="decisions2" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Agenda Items :</label>
                                            <div class="c-inputs-stacked">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item21">
                                                    <label class="custom-control-label" for="item21">1st item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item22">
                                                    <label class="custom-control-label" for="item22">2nd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item23">
                                                    <label class="custom-control-label" for="item23">3rd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item24">
                                                    <label class="custom-control-label" for="item24">4th item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item25">
                                                    <label class="custom-control-label" for="item25">5th item</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-money"></i>الدفعات</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meetingName2">Name of Meeting :</label>
                                            <input type="text" class="form-control" id="meetingName2">
                                        </div>

                                        <div class="form-group">
                                            <label for="meetingLocation2">Location :</label>
                                            <input type="text" class="form-control" id="meetingLocation2">
                                        </div>

                                        <div class="form-group">
                                            <label for="participants2">Names of Participants</label>
                                            <textarea name="participants" id="participants2" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="decisions2">Decisions Reached</label>
                                            <textarea name="decisions" id="decisions2" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Agenda Items :</label>
                                            <div class="c-inputs-stacked">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item21">
                                                    <label class="custom-control-label" for="item21">1st item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item22">
                                                    <label class="custom-control-label" for="item22">2nd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item23">
                                                    <label class="custom-control-label" for="item23">3rd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item24">
                                                    <label class="custom-control-label" for="item24">4th item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item25">
                                                    <label class="custom-control-label" for="item25">5th item</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-files-o"></i>فواتير المشتريات</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meetingName2">Name of Meeting :</label>
                                            <input type="text" class="form-control" id="meetingName2">
                                        </div>

                                        <div class="form-group">
                                            <label for="meetingLocation2">Location :</label>
                                            <input type="text" class="form-control" id="meetingLocation2">
                                        </div>

                                        <div class="form-group">
                                            <label for="participants2">Names of Participants</label>
                                            <textarea name="participants" id="participants2" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="decisions2">Decisions Reached</label>
                                            <textarea name="decisions" id="decisions2" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Agenda Items :</label>
                                            <div class="c-inputs-stacked">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item21">
                                                    <label class="custom-control-label" for="item21">1st item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item22">
                                                    <label class="custom-control-label" for="item22">2nd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item23">
                                                    <label class="custom-control-label" for="item23">3rd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item24">
                                                    <label class="custom-control-label" for="item24">4th item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item25">
                                                    <label class="custom-control-label" for="item25">5th item</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 4 -->
                            <h6><i class="step-icon la la-link"></i>الملحقات</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meetingName2">Name of Meeting :</label>
                                            <input type="text" class="form-control" id="meetingName2">
                                        </div>

                                        <div class="form-group">
                                            <label for="meetingLocation2">Location :</label>
                                            <input type="text" class="form-control" id="meetingLocation2">
                                        </div>

                                        <div class="form-group">
                                            <label for="participants2">Names of Participants</label>
                                            <textarea name="participants" id="participants2" rows="4" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="decisions2">Decisions Reached</label>
                                            <textarea name="decisions" id="decisions2" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Agenda Items :</label>
                                            <div class="c-inputs-stacked">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item21">
                                                    <label class="custom-control-label" for="item21">1st item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item22">
                                                    <label class="custom-control-label" for="item22">2nd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item23">
                                                    <label class="custom-control-label" for="item23">3rd item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item24">
                                                    <label class="custom-control-label" for="item24">4th item</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="agenda2" class="custom-control-input"
                                                        id="item25">
                                                    <label class="custom-control-label" for="item25">5th item</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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


    <script src="{{ asset('theme/app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>

    <script src="{{ asset('theme/app-assets/js/scripts/forms/wizard-steps.min.js') }}"></script>


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
