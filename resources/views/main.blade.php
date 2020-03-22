<!DOCTYPE html>
<!-- version v3.0.0 -->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Sistem Penilaian Berkomputer">
    <meta name="author" content="CDN Information Integration System">
    <meta name="keyword" content="Penilaian,Berkomputer,Pentaksiran,PBT,Majlis Daerah">
    <title>CDN Information Integration System</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('favicon/apple-icon-57x57.png') !!}">
    <link rel="apple-touch-icon" sizes="60x60" href="{!! asset('favicon/apple-icon-60x60.png') !!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('favicon/apple-icon-72x72.png') !!}">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('favicon/apple-icon-76x76.png') !!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('favicon/apple-icon-114x114.png') !!}">
    <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('favicon/apple-icon-120x120.png') !!}">
    <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('favicon/apple-icon-144x144.png') !!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('favicon/apple-icon-152x152.png') !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('favicon/apple-icon-180x180.png') !!}">
    <link rel="icon" type="image/png" sizes="192x192" href="{!! asset('favicon/android-icon-192x192.png') !!}">
    <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('favicon/favicon-32x32.png') !!}">
    <link rel="icon" type="image/png" sizes="96x96" href="{!! asset('favicon/favicon-96x96.png') !!}">
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('favicon/favicon-16x16.png') !!}">
    <link rel="manifest" href="{!! asset('favicon/manifest.json') !!}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{!! asset('favicon/ms-icon-144x144.png') !!}">
    <meta name="theme-color" content="#ffffff">
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="{!! asset('css/app1.min.css') !!}">
    <link media="all" type="text/css" rel="stylesheet" href="{!! asset('css/app2.css') !!}">
    <link media="all" type="text/css" rel="stylesheet" href="{!! asset('css/magnific-popup.css') !!}">
    <link media="all" type="text/css" rel="stylesheet" href="{!! asset('css/cropper.min.css') !!}">
    @yield("page-css")
</head>

<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-lg-down-none">
            <img class="c-sidebar-brand-full" width="118" height="46" src="{!! asset('images/full_logo.png') !!}">            
            <img class="c-sidebar-brand-minimized" width="46" height="46" src="{!! asset('images/logo.png') !!}">
        </div>
        <ul class="c-sidebar-nav">
            @if (\Auth::user()->role == 'ADMINISTRATOR')
            @include("menu.administrator")
            @elseif (\Auth::user()->role == 'STAFF')
            @include("menu.staff")
            @endif
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper c-fixed-components">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{!! asset('icons/free.svg#cil-menu') !!}"></use>
                </svg>
            </button><a class="c-header-brand d-lg-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{!! asset('icons/coreui.svg#full') !!}"></use>
                </svg></a>
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                <svg class="c-icon c-icon-lg">
                    <use xlink:href="{!! asset('icons/free.svg#cil-menu') !!}"></use>
                </svg>
            </button>
            <ul class="c-header-nav ml-auto mr-4">
                <li class="c-header-nav-item dropdown">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="c-avatar">
                            <img class="c-avatar-img" src="{!! URL::to('asset/image?in=avatar&filename=' . \App\Libs\App::getFilename('image', \Auth::user()->avatar)) !!}">
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <strong>Account</strong>
                        </div>
                        <a class="dropdown-item" href="{!! URL::to('profile') !!}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{!! asset('icons/free.svg#cil-user') !!}"></use>
                            </svg> Profile
                        </a>
                        <a class="dropdown-item" href="{!! URL::to('password') !!}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{!! asset('icons/free.svg#cil-lock-locked') !!}"></use>
                            </svg> Change Password
                        </a>
                        <a class="dropdown-item" href="{!! URL::to('logout') !!}">
                            <svg class="c-icon mr-2">
                                <use xlink:href="{!! asset('icons/free.svg#cil-account-logout') !!}"></use>
                            </svg> Logout
                        </a>
                    </div>
                </li>
            </ul>
            <div class="c-subheader px-3">
                <ol class="breadcrumb border-0 m-0">
                    {!! $breadcrumb !!}
                </ol>
            </div>
        </header>
        <div class="c-body">
            <main class="c-main">
                <div id="loadPanel"></div>
                <div class="container-fluid">
                    @yield("modal")
                    <div class="fade-in">
                        @yield("content")
                    </div>
                </div>
            </main>
            <div id="toastContainer"></div>
            <footer class="c-footer">
                <div>CDN Information Integration System v2020.1</div>
                <div class="ml-auto">© 2020 Royal Malaysian Customs Department</div>
            </footer>
        </div>
    </div>
    <script src="{!! asset('js/jquery.min.js') !!}"></script>
    <script src="{!! asset('js/moment-with-locales.min.js') !!}"></script>
    <script src="{!! asset('js/app1.min.js') !!}"></script>
    <script src="{!! asset('js/app2.js') !!}"></script>
    <script src="{!! asset('js/coreui.bundle.min.js') !!}"></script>
    <script src="{!! asset('js/jquery.magnific-popup.min.js') !!}"></script>
    <script src="{!! asset('js/cropper.min.js') !!}"></script>
    <!--[if IE]><!-->
    <script src="{!! asset('js/svgxuse.min.js') !!}"></script>
    <!--<![endif]-->
    <script src="{!! asset('js/svgxuse.min.js') !!}"></script>
    @yield("page-script")
    @if ($errors->any())
    <script type="text/javascript">
        $(document).ready(function () {
            var a = '';
            @foreach ($errors->all() as $error)
                    a = a + '{{ $error }}\n';
            @endforeach
            $("#toastContainer").dxToast({message: a,type: "error",width: 280,position: {my: "right",at: "top right",offset: '-20 0',of: ".c-subheader"},displayTime: 10000});
            $("#toastContainer").dxToast("show");
        })
    </script>
    @endif
    @if ($message = Session::get('error'))
    <script type="text/javascript">
        $(document).ready(function () {
            $("#toastContainer").dxToast({message: '{!! e(Session::get('error')) !!}',type: "error",width: 280,position: {my: "right",at: "top right",offset: '-20 0',of: ".c-subheader"},displayTime: 5000});
            $("#toastContainer").dxToast("show");
        })
    </script>
    @endif
    @if ($message = Session::get('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            $("#toastContainer").dxToast({message: '{!! e(Session::get('success')) !!}',type: "success",width: 280,position: {my: "right",at: "top right",offset: '-20 0',of: ".c-subheader"},displayTime: 5000,});
            $("#toastContainer").dxToast('instance').show();
        })
    </script>
    @endif
</body>

</html>