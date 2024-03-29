<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="{{ route('home') }}"><img
                            class="brand-logo" alt="modern admin logo"
                            src="{{ asset('theme/app-assets/images/logo/logo_2.png') }}">
                        <h3 class="brand-text">ERP</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                    <li class="dropdown nav-item mega-dropdown d-none d-lg-block" style="display: none"><a
                            class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">أدوات</a>
                        <ul class="mega-dropdown-menu dropdown-menu row p-1">
                            <li class="col-md-4 bg-mega p-2">
                                <h3 class="text-white mb-1 font-weight-bold">أرسل رسالة واتساب</h3>
                                <form action="https://api.whatsapp.com/send/" method="GET" target="_blank">
                                    <input type="text" name="phone" class="form-control" placeholder="رقم الموبايل" />
                                    <textarea name="text" class="form-control" placeholder="محتوى الرسالة"></textarea>
                                    <button class="btn btn-outline-white">أرسل</button>
                                </form>
                            </li>
                            <li class="col-md-5 px-2">

                                <h6 class="font-weight-bold font-medium-2 ml-1">ارسل ايميل </h6>
                                <ul class="row mt-2">
                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3"
                                            href="https://mail.google.com/" target="_blank"><i
                                                class="la la-envelope font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-0">Gmail</p>
                                        </a></li>
                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3"
                                            href="https://outlook.com/" target="_blank"><i
                                                class="la la-envelope font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-0">Outlook</p>
                                        </a></li>
                                    {{-- <li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3"
                                            href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/rtl/travel-menu-template"
                                            target="_blank"><i class="la la-plane font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-0">Travel</p>
                                        </a></li>
                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3 mt-75 mt-xl-0"
                                            href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/rtl/hospital-menu-template"
                                            target="_blank"><i class="la la-stethoscope font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-0">Hospital</p>
                                        </a></li>
                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0"
                                            href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/rtl/crypto-menu-template"
                                            target="_blank"><i class="la la-bitcoin font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-50">Crypto</p>
                                        </a></li>
                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0"
                                            href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/rtl/support-menu-template"
                                            target="_blank"><i class="la la-tag font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-50">Support</p>
                                        </a></li>
                                    <li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0"
                                            href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/html/rtl/bank-menu-template"
                                            target="_blank"><i class="la la-bank font-large-1 mr-0"></i>
                                            <p class="font-medium-2 mt-25 mb-50">Bank</p>
                                        </a></li> --}}
                                </ul>
                            </li>
                            <script type="text/javascript">
                                function popx(url) {
                                    popupWindow = window.open(
                                        url, 'popUpWindow',
                                        'height=500,width=380,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no'
                                    )
                                }
                            </script>
                            <li class="col-md-3">
                                <h6 class="font-weight-bold font-medium-2">المزيد</h6>
                                <ul class="row mt-1 mt-xl-2">
                                    <li class="col-12 col-xl-6 pl-0">
                                        <ul class="mega-component-list">
                                            <li class="mega-component-item">
                                                <a href="#" class="mb-1 mb-xl-2"
                                                    onclick="return popx('{{ route('others.calculator') }}')">
                                                    <i class="la la-calculator font-large-1 mr-0"></i>
                                                    الاله الحاسبة
                                                </a>
                                            </li>
                                            {{-- <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-callout.html" target="_blank">Callout</a></li>
                                            <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-buttons-basic.html" target="_blank">Buttons</a></li>
                                            <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-carousel.html" target="_blank">Carousel</a></li> --}}
                                        </ul>
                                    </li>
                                    {{-- <li class="col-12 col-xl-6 pl-0">
                                        <ul class="mega-component-list">
                                            <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-dropdowns.html" target="_blank">Drop Down</a></li>
                                            <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-list-group.html" target="_blank">List Group</a></li>
                                            <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-modals.html" target="_blank">Modals</a></li>
                                            <li class="mega-component-item"><a class="mb-1 mb-xl-2"
                                                    href="component-pagination.html" target="_blank">Pagination</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="Explore Modern..." tabindex="0"
                                data-search="template-list">
                            <div class="search-input-close"><i class="ft-x"></i></div>
                            <ul class="search-list"></ul>
                        </div>
                    </li> --}}
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">{!! $language->flag !!}<span
                                class="selected-language"></span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            @foreach ($languages as $lang)
                            <a class="dropdown-item" href="#" data-language="en">{!!$lang->flag!!} {{$lang->title}}</a>
                            @endforeach
                            </div>
                    </li>
                    @if ($notificationCount > 0)
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                data-toggle="dropdown"><i class="ficon ft-bell"></i><span
                                    class="badge badge-pill badge-danger badge-up badge-glow">{{ $notificationCount }}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">التنبيهات</span></h6>
                                    <span
                                        class="notification-tag badge badge-danger float-right m-0">{{ $notificationCount }}</span>
                                </li>
                                <li class="scrollable-container media-list w-100">
                                    @if ($lateInvoiceDates->count() > 0)
                                        @foreach ($lateInvoiceDates as $noificationsThree)
                                            <a href="{{ route('installments.pay', [1,$noificationsThree->id]) }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-alert-circle icon-bg-circle bg-red bg-darken-1 mr-0"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading red darken-1">دفعة متأخرة على فاتورة
                                                            مبيعات رقم {{ $noificationsThree->invoice_id }}</h6>
                                                        <p class="notification-text font-small-3 text-muted">بقيمة
                                                            {{ $noificationsThree->amount }} ج.م</p><small>
                                                            <time class="media-meta text-muted"
                                                                datetime="{{ $noificationsThree->date }}">{{ $noificationsThree->date }}</time></small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                    @if ($latePurchasesDates->count() > 0)
                                        @foreach ($latePurchasesDates as $noificationsFour)
                                            <a
                                                href="{{ route('installments.pay', [2,$noificationsFour->id]) }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-alert-circle icon-bg-circle bg-red bg-darken-1 mr-0"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading red darken-1">دفعة متأخرة على أمر شراء
                                                            رقم {{ $noificationsFour->purchase_id }}</h6>
                                                        <p class="notification-text font-small-3 text-muted">بقيمة
                                                            {{ $noificationsFour->amount }} ج.م</p><small>
                                                            <time class="media-meta text-muted"
                                                                datetime="{{ $noificationsFour->date }}">{{ $noificationsFour->date }}</time></small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                    @if ($nextInvoiceDates->count() > 0)
                                        @foreach ($nextInvoiceDates as $noificationsOne)
                                            <a href="{{ route('installments.pay', [1,$noificationsOne->id]) }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3 mr-0"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading yellow darken-3">دفعة قادمة على فاتورة
                                                            مبيعات رقم {{ $noificationsOne->invoice_id }}</h6>
                                                        <p class="notification-text font-small-3 text-muted">
                                                            بقيمة {{ $noificationsOne->amount }} ج.م
                                                        </p><small>
                                                            <time class="media-meta text-muted"
                                                                datetime="{{ $noificationsOne->date }}">تاريخ
                                                                الإستحقاق{{ $noificationsOne->date }}</time></small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                    @if ($nextPurchasesDates->count() > 0)
                                        @foreach ($nextPurchasesDates as $noificationsTwo)
                                            <a
                                                href="{{ route('installments.pay', [2,$noificationsTwo->id]) }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3 mr-0"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading yellow darken-3">دفعة قادمة على أمر
                                                            شراء رقم {{ $noificationsTwo->purchase_id }}</h6>
                                                        <p class="notification-text font-small-3 text-muted">
                                                            بقيمة {{ $noificationsTwo->amount }} ج.م
                                                        </p><small>
                                                            <time class="media-meta text-muted"
                                                                datetime="{{ $noificationsTwo->date }}">تاريخ
                                                                الإستحقاق{{ $noificationsTwo->date }}</time></small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                    @if ($upcomingFundPayments->count() > 0)
                                        @foreach ($upcomingFundPayments as $noificationsFive)
                                            <a href="{{ route('installments.pay', [3,$noificationsFive->id]) }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-alert-triangle icon-bg-circle bg-info bg-darken-3 mr-0"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading info darken-3">موعد سداد تمويل خارجي
                                                            رقم {{ $noificationsFive->id }}</h6>
                                                        <p class="notification-text font-small-3 text-muted">
                                                            بقيمة {{ $noificationsFive->amount }} ج.م
                                                        </p><small>
                                                            <time class="media-meta text-muted"
                                                                datetime="{{ $noificationsFive->refund_date }}">تاريخ
                                                                الإستحقاق{{ $noificationsFive->refund_date }}</time></small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </li>
                                {{-- <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                    href="javascript:void(0)">Read all notifications</a></li> --}}
                            </ul>
                        </li>
                    @endif
                    @if($productsNotifications->count() > 0)
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                            data-toggle="dropdown"><i class="ficon ft-alert-triangle danger"></i></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="danger darken-2">تنبيهات الأصناف التي على وشك النفاذ</span></h6><span
                                    class="notification-tag badge badge-warning float-right m-0">-</span>
                            </li>
                            <li class="scrollable-container media-list w-100">
                                @if($productsNotifications->count() == 0)
                                <br>
                                <p class="warning text-center">لا يوجد</p>
                                @endif
                                @foreach ($productsNotifications as $productsNotification)



                                <a
                                    href="{{route('products.view',$productsNotification->id)}}">
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="ficon ft-box warning"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">{{$productsNotification->product_name}}</h6>
                                            <p class="notification-text font-small-3 text-muted">المخزون الحالي أقل من {{$productsNotification->product_low_stock_thershold}}</p>
                                            {{--<small>
                                             <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small> --}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </li>
                            {{-- <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li> --}}
                        </ul>
                    </li>
                    @endif
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown"><span
                                class="mr-1 user-name text-bold-700">{{ Auth::user()->username }}</span><span
                                class="avatar avatar-online">
                                @if (!isset(Auth::user()->profile_pic))
                                    <img src="{{ asset('theme/app-assets/images/custom/no-profile.jpg') }}"
                                        alt="avatar">
                                @else
                                    <img src="{{ asset($myPP) }}" alt="avatar" />
                                @endif
                                <i></i>
                            </span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('users.view', Auth::user()->id) }}"><i
                                    class="ft-user"></i> الملف الشخصي</a>
                            {{-- <a class="dropdown-item" href="app-kanban.html"><i class="ft-clipboard"></i> Todo</a> --}}
                            {{-- <a class="dropdown-item" href="user-cards.html"><i class="ft-check-square"></i> Task</a> --}}
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i> تسجيل الخروج
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
