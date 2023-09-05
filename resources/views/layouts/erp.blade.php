<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading" data-textdirection="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gesture ERP | @yield('title')</title>

    <!-- Scripts -->
    <!-- <script src="{{-- asset('js/app.js') --}}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{-- asset('css/app.css') --}}" rel="stylesheet"> -->


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/vendors-rtl.min.css') }}">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css-rtl/custom-rtl.min.css') }}">
    <!-- END: Theme CSS-->

    <script>
        // Function to prevent right-click and context menu, except for localhost
        document.addEventListener('contextmenu', function (e) {
            if (location.hostname !== 'localhost') {
                e.preventDefault();
            }
        });

        // Function to disable inspect window, except for localhost
        document.addEventListener('keydown', function (e) {
            if ((e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) &&
                location.hostname !== 'localhost') {
                e.preventDefault();
            }
        });
    </script>

 @yield('pageCss')

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style-rtl.css') }}">
    <!-- END: Custom CSS-->

</head>
@if(null !== Route::current())
@if(Route::current()->getName() == 'login')
<body class="vertical-layout vertical-compact-menu 1-column blank-page" data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
@else
<body class="vertical-layout vertical-compact-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
@endif
@endif
    <div>
    <div class="app-content content">
            @yield('content')
    </div>
    <!-- BEGIN: Vendor JS-->
        <script src="{{ asset('theme/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    <script>
        CairoRegular = "{{ asset('theme/app-assets/fonts/Cairo/Cairo-Regular.ttf') }}";
        CairoBold = "{{ asset('theme/app-assets/fonts/Cairo/Cairo-Bold.ttf') }}";
        CompanyName = "{{ $globalSettings->value }}";
        waterMark = "{{ $globalSettings->value }}";
    </script>
    @yield('pageJs')
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('theme/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/scripts/footer.min.js') }}"></script>
    <script src="{{ asset('theme/app-assets/js/custom.js') }}"></script>
    <!-- END: Theme JS-->
</body>
</html>
