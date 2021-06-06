<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CDN Information Integration System</title>
    <meta name="description" content="How it works">
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

<body class="mod-bg-1 mod-nav-link mod-main-boxed nav-function-top">
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
        <aside class="page-sidebar">
            <div class="page-logo">
                <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                    <img src="{{ asset('images/logo.svg') }}" alt="CDN System" class="profile-image rounded-circle" style="width: 52px;height: 52px" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">CDN System <i>for</i> Royal Malaysian Customs</span>
                </a>
            </div>
            <!-- BEGIN PRIMARY NAVIGATION -->
            <nav id="js-primary-nav" class="primary-nav" role="navigation">
                <div class="nav-filter">
                    <div class="position-relative">
                        <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                        <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active"
                           data-target=".page-sidebar">
                            <i class="fal fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="info-card">
                    <img src="{{ URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', \Auth::user()->avatar)) }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                    <div class="info-card-text">
                        <a href="#" class="d-flex align-items-center text-white">
                            <span class="text-truncate text-truncate-sm d-inline-block">
                                {{ \Auth::user()->fullname }}
                            </span>
                        </a>
                    </div>
                    <img src="{{ asset('images/card-backgrounds/cover-4-lg.png') }}" class="cover" alt="cover">
                    <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar"
                       data-focus="nav_filter_input">
                        <i class="fal fa-angle-down"></i>
                    </a>
                </div>
                <ul id="js-nav-menu" class="nav-menu">
                    <li class="@if ($menu['menu'] == 'Home') active @endif">
                        <a href="{{ url()->to('/') }}" title="Dashboard" data-filter-tags="dashboard">
                            <i class="fal fa-dashcube"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    @if (strpos(Auth::user()->role, 'ADMINISTRATOR') !== false)
                        <li class="@if ($menu['menu'] == 'User') active @endif">
                            <a href="{{ route('user.index') }}" title="Dashboard" data-filter-tags="users">
                                <i class="fal fa-users"></i>
                                <span class="nav-link-text">Users</span>
                            </a>
                        </li>
                    @endif
                    @if (strpos(Auth::user()->role, 'STAFF') !== false)
                        <li class="@if ($menu['menu'] == 'Tax') active @endif">
                            <a href="{{ route('tax.index') }}" title="Dashboard" data-filter-tags="tax records">
                                <i class="fal fa-tags"></i>
                                <span class="nav-link-text">Tax Records</span>
                            </a>
                        </li>
                    @endif
                    @if (strpos(Auth::user()->role, 'ADMINISTRATOR') !== false)
                        <li class="@if ($menu['menu'] == 'Config') active @endif">
                            <a href="{{ url()->to('config') }}" title="Dashboard" data-filter-tags="settings">
                                <i class="fal fa-cog"></i>
                                <span class="nav-link-text">Settings</span>
                            </a>
                        </li>
                    @endif
                    <li class="@if ($menu['menu'] == 'Report') active show @endif">
                        <a href="#" title="Reports" data-filter-tags="report">
                            <i class="fal fa-info-circle"></i>
                            <span class="nav-link-text">Reports</span>
                        </a>
                        <ul>
                            <li class="@if ($menu['subMenu'] == 'Risk Entity') active @endif">
                                <a href="{{ url()->to('report/risk_entity') }}" title="Introduction" data-filter-tags="application intel introduction">
                                    <span class="nav-link-text">Entiti Cukai Jualan</span>
                                </a>
                            </li>
                            <li class="@if ($menu['subMenu'] == 'Risk Person') active @endif">
                                <a href="{{ url()->to('report/risk_person') }}" title="Privacy" data-filter-tags="application intel privacy">
                                    <span class="nav-link-text">Orang Berdaftar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="filter-message js-filter-message bg-success-600"></div>
            </nav>
            <div class="nav-footer shadow-top">
                <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
                    <i class="ni ni-chevron-right"></i>
                    <i class="ni ni-chevron-right"></i>
                </a>
                <ul class="list-table m-auto nav-footer-buttons">
                    <li>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                            <i class="fal fa-comments"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                            <i class="fal fa-life-ring"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                            <i class="fal fa-phone"></i>
                        </a>
                    </li>
                </ul>
            </div> <!-- END NAV FOOTER -->
        </aside>
        <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
            <header class="page-header" role="banner">
                <!-- we need this logo when user switches to nav-function-top -->
                <div class="page-logo">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                        <img src="{{ asset('images/logo.svg') }}" alt="CDN System" class="profile-image rounded-circle" style="width: 52px;height: 52px"
                             aria-roledescription="logo">
                        <span class="page-logo-text mr-1">CDN System <i>for</i> Royal Malaysian Customs</span>
                    </a>
                </div>
                <!-- DOC: nav menu layout change shortcut -->
                <div class="hidden-md-down dropdown-icon-menu position-relative">
                    <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                        <i class="ni ni-menu"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                <i class="ni ni-minify-nav"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                <i class="ni ni-lock-nav"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- DOC: mobile button appears during mobile width -->
                <div class="hidden-lg-up">
                    <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                        <i class="ni ni-menu"></i>
                    </a>
                </div>
                <div class="search">
                    <form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
                        <input type="text" id="search-field" placeholder="Search company name or SST number" class="form-control" tabindex="1" style="text-transform: none">
                        <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on">
                            <i class="fal fa-times"></i>
                        </a>
                    </form>
                </div>
                <div class="ml-auto d-flex">
                    <!-- activate app search icon (mobile) -->
                    <div class="hidden-sm-up">
                        <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                            <i class="fal fa-search"></i>
                        </a>
                    </div>
                    <!-- app notification -->
                {{--                    <div>--}}
                {{--                        <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">--}}
                {{--                            <i class="fal fa-bell"></i>--}}
                {{--                            <span class="badge badge-icon">11</span>--}}
                {{--                        </a>--}}
                {{--                        <div class="dropdown-menu dropdown-menu-animated dropdown-xl">--}}
                {{--                            <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">--}}
                {{--                                <h4 class="m-0 text-center color-white">--}}
                {{--                                    11 New--}}
                {{--                                    <small class="mb-0 opacity-80">User Notifications</small>--}}
                {{--                                </h4>--}}
                {{--                            </div>--}}
                {{--                            <div class="custom-scroll h-100">--}}
                {{--                                <ul class="notification">--}}
                {{--                                    <li class="unread">--}}
                {{--                                        <a href="#" class="d-flex align-items-center">--}}
                {{--                                            <span class="status mr-2">--}}
                {{--                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('{{ asset('images/demo/avatars/avatar-c.png') }}')"></span>--}}
                {{--                                            </span>--}}
                {{--                                            <span class="d-flex flex-column flex-1 ml-1">--}}
                {{--                                                <span class="name">Melissa Ayre <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>--}}
                {{--                                                <span class="msg-a fs-sm">Re: New security codes</span>--}}
                {{--                                                <span class="msg-b fs-xs">Hello again and thanks for being part...</span>--}}
                {{--                                                <span class="fs-nano text-muted mt-1">56 seconds ago</span>--}}
                {{--                                            </span>--}}
                {{--                                        </a>--}}
                {{--                                    </li>--}}
                {{--                                </ul>--}}
                {{--                            </div>--}}
                {{--                            <div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">--}}
                {{--                                <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <!-- app user menu -->
                    <div>
                        <a href="#" data-toggle="dropdown" title="{{ \Auth::user()->username }}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                            <img src="{{ URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', \Auth::user()->avatar)) }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                            <!-- you can also add username next to the avatar with the codes below:
                            <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
                            <i class="ni ni-chevron-down hidden-xs-down"></i> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                            <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <span class="mr-2">
                                                <img src="{{ URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', \Auth::user()->avatar)) }}" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                            </span>
                                    <div class="info-card-text">
                                        <div class="fs-lg text-truncate text-truncate-lg">{{ \Auth::user()->fullname }}</div>
                                        <span class="text-truncate text-truncate-md opacity-80">
                                            {{ \Auth::user()->username }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a href="{{ url()->to('profile') }}" class="dropdown-item">
                                <span>Profile</span>
                            </a>
                            <a href="{{ url()->to('password') }}" class="dropdown-item">
                                <span>Change Password</span>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item fw-500 pt-3 pb-3" href="{{ url()->to('logout') }}">
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
            <main id="js-page-content" role="main" class="page-content">
                <ol class="breadcrumb page-breadcrumb">
                    {!! $breadcrumb !!}
                    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                </ol>
                <div class="subheader mb-3">
                    <h2 class="subheader-title">
                        {{ $title }}
                    </h2>
                </div>
                @yield("content")
                @yield("modal")
            </main>
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700">2021 © CDN Information Integration System V2021.1</span>
                </div>
                <div>
                    <ul class="list-table m-0">
                        <li>
                            <a href="intel_introduction.html" class="text-secondary fw-700">About CDN</a>
                        </li>
                        <li class="pl-3">
                            <a href="{{ asset('user_manual.pdf') }}" target="_blank" style="text-decoration: none !important;" class="text-secondary fw-700">User Manual</a>
                        </li>
                        <li class="pl-3 fs-xl">
                            <a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary" target="_blank">
                                <i class="fal fa-question-circle" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </footer>
            <!-- END Page Footer -->
            <!-- BEGIN Color profile -->
            <!-- this area is hidden and will not be seen on screens or screen readers -->
            <!-- we use this only for CSS color reference for JS stuff -->
            <p id="js-color-profile" class="d-none">
                <span class="color-primary-50"></span>
                <span class="color-primary-100"></span>
                <span class="color-primary-200"></span>
                <span class="color-primary-300"></span>
                <span class="color-primary-400"></span>
                <span class="color-primary-500"></span>
                <span class="color-primary-600"></span>
                <span class="color-primary-700"></span>
                <span class="color-primary-800"></span>
                <span class="color-primary-900"></span>
                <span class="color-info-50"></span>
                <span class="color-info-100"></span>
                <span class="color-info-200"></span>
                <span class="color-info-300"></span>
                <span class="color-info-400"></span>
                <span class="color-info-500"></span>
                <span class="color-info-600"></span>
                <span class="color-info-700"></span>
                <span class="color-info-800"></span>
                <span class="color-info-900"></span>
                <span class="color-danger-50"></span>
                <span class="color-danger-100"></span>
                <span class="color-danger-200"></span>
                <span class="color-danger-300"></span>
                <span class="color-danger-400"></span>
                <span class="color-danger-500"></span>
                <span class="color-danger-600"></span>
                <span class="color-danger-700"></span>
                <span class="color-danger-800"></span>
                <span class="color-danger-900"></span>
                <span class="color-warning-50"></span>
                <span class="color-warning-100"></span>
                <span class="color-warning-200"></span>
                <span class="color-warning-300"></span>
                <span class="color-warning-400"></span>
                <span class="color-warning-500"></span>
                <span class="color-warning-600"></span>
                <span class="color-warning-700"></span>
                <span class="color-warning-800"></span>
                <span class="color-warning-900"></span>
                <span class="color-success-50"></span>
                <span class="color-success-100"></span>
                <span class="color-success-200"></span>
                <span class="color-success-300"></span>
                <span class="color-success-400"></span>
                <span class="color-success-500"></span>
                <span class="color-success-600"></span>
                <span class="color-success-700"></span>
                <span class="color-success-800"></span>
                <span class="color-success-900"></span>
                <span class="color-fusion-50"></span>
                <span class="color-fusion-100"></span>
                <span class="color-fusion-200"></span>
                <span class="color-fusion-300"></span>
                <span class="color-fusion-400"></span>
                <span class="color-fusion-500"></span>
                <span class="color-fusion-600"></span>
                <span class="color-fusion-700"></span>
                <span class="color-fusion-800"></span>
                <span class="color-fusion-900"></span>
            </p>
            <!-- END Color profile -->
        </div>
    </div>
</div>
<script src="{{ asset('js/vendors.bundle.js') }}"></script>
<script src="{{ asset('js/app.bundle.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/app1.min.js') }}"></script>
<script src="{{ asset('js/app2.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/cropper.min.js') }}"></script>
@yield("page-script")
@if ($errors->any())
    <script type="text/javascript">
        $(document).ready(function () {
            var a = '';
            @foreach ($errors->all() as $error)
                a = a + '{{ $error }}\n';
            @endforeach
            $("#toastContainer").dxToast({
                message: a,
                type: "error",
                width: 280,
                position: {my: "right", at: "top right", offset: '-20 0', of: ".c-subheader"},
                displayTime: 10000
            });
            $("#toastContainer").dxToast("show");
        })
    </script>
@endif
@if ($message = Session::get('error'))
    <script type="text/javascript">
        $(document).ready(function () {
            $("#toastContainer").dxToast({
                message: '{!! e(Session::get('error')) !!}',
                type: "error",
                width: 280,
                position: {my: "right", at: "top right", offset: '-20 0', of: ".c-subheader"},
                displayTime: 5000
            });
            $("#toastContainer").dxToast("show");
        })
    </script>
@endif
@if ($message = Session::get('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            $("#toastContainer").dxToast({
                message: '{!! e(Session::get('success')) !!}',
                type: "success",
                width: 280,
                position: {my: "right", at: "top right", offset: '-20 0', of: ".c-subheader"},
                displayTime: 5000,
            });
            $("#toastContainer").dxToast('instance').show();
        })
    </script>
@endif
</body>
</html>
