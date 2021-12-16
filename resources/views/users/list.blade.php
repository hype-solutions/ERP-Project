@extends('layouts.erp2')
@section('title', 'قائمة المستخدمين')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="{{ gesture_asset('css/vertical-compact-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ gesture_asset('css/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ gesture_asset('css/users.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/tables/datatable/datatables.min.css') }}"> --}}
@endsection

@section('content')
    @include('common.header')
    @include('common.mainmenu')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">قائمة المستخدمين</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">البرنامج</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.list') }}">المستخدمين</a></li>
                            <li class="breadcrumb-item active">استعراض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-6 col-12">
                <div class="btn-group">
                    <a href="{{ route('users.add') }}" class="btn btn-outline-success block btn-lg">
                        إضافه مستخدم جديد
                    </a>

                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- users list start -->
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



                @if (session()->has('success'))
                    @if (session()->get('success') == 'User Deleted')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> حذف بيانات مستخدم
                        </div>
                    @elseif (session()->get('success') == 'Reset Sent')
                        <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                            <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>تم بنجاح!</strong> إرسال رابط لتغيير كلمة المرور للمستخدم
                        </div>
                    @endif
                @endif
                <div class="users-list-filter px-1">
                    <form>
                        <div class="row border border-light rounded py-2 mb-2">
                            {{-- <div class="col-12 col-sm-6 col-lg-3">
                                <label for="users-list-verified">Verified</label>
                                <fieldset class="form-group">
                                    <select class="form-control" id="users-list-verified">
                                        <option value="">Any</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </fieldset>
                            </div> --}}
                            <div class="col-12 col-sm-6 col-lg-3">
                                <label for="users-list-role">نوع المستخدم</label>
                                <fieldset class="form-group">
                                    <select class="form-control" id="users-list-role">
                                        <option value="all">الكل</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            {{-- <div class="col-12 col-sm-6 col-lg-3">
                                <label for="users-list-status">Status</label>
                                <fieldset class="form-group">
                                    <select class="form-control" id="users-list-status">
                                        <option value="">Any</option>
                                        <option value="Active">Active</option>
                                        <option value="Close">Close</option>
                                        <option value="Banned">Banned</option>
                                    </select>
                                </fieldset>
                            </div> --}}
                            <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                <button class="btn btn-block btn-primary glow" type="button"
                                    id="tableSearch">إستعراض</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="users-list-table">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table class="table" id="usersTable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>رقم المستخدم</th>
                                                <th>نوع المستخدم</th>
                                                <th>الإسم</th>
                                                <th>username</th>
                                                <th>التواصل</th>
                                                <th>التحكم</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                                <!-- datatable ends -->

                                <div class="modal fade text-left" id="edit_profilePicture" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1"> تعديل
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="post" id="edit_profilePicture_form"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="timesheetinput2">الصورة
                                                                        الشخصية</label>
                                                                    <br />
                                                                    <input type="file" name="profile_pic" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                            data-dismiss="modal"><i class="ft-x"></i>
                                                            الغاء</button>
                                                        <button type="submit" class="btn btn-outline-primary"><i
                                                                class="la la-check-square-o"></i>
                                                            حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade text-left" id="edit_signature" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1"> تعديل
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form" method="post"
                                                    action="{{ route('users.signature', ':id') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="timesheetinput2">التوقيع</label>
                                                                    <br />
                                                                    <input type="file" name="signature" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn grey btn-outline-secondary"
                                                            data-dismiss="modal"><i class="ft-x"></i>
                                                            الغاء</button>
                                                        <button type="submit" class="btn btn-outline-primary"><i
                                                                class="la la-check-square-o"></i>
                                                            حفظ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
    @include('components.scripts.users')
@endsection


@section('pageJs')



@endsection
