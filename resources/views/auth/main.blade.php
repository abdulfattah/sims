<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CDN Information Integration System</title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="msapplication-tap-highlight" content="no">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{ asset('css/vendors.bundle.css') }}">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="{{ asset('css/app.bundle.css') }}">
    <link id="myskin" rel="stylesheet" media="screen, print" href="{{ asset('css/skins/skin-master.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="{{ asset('css/theme-demo.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app1.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app2.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/cropper.min.css') }}">
    @yield("page-css")
</head>
<body>
<div class="page-wrapper auth">
    <div class="page-inner bg-brand-gradient">
        <div class="page-content-wrapper bg-transparent m-0">
            <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                <div class="d-flex align-items-center container p-0">
                    <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                            <img src="{{ asset('images/logo (2).svg') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">CDN System</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-1" style="background: url({{ asset('images/svg/pattern-1.svg') }}) no-repeat center bottom fixed; background-size: cover;">
                <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                    @yield('content')
                    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                        2021 © CDN Information Integration System V2021.1
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/vendors.bundle.js') }}"></script>
<script src="{{ asset('js/app.bundle.js') }}"></script>
<script src="{{ asset('js/app1.min.js') }}"></script>
<script src="{{ asset('js/app2.js') }}"></script>
@yield("page-script")
</body>
</html>
