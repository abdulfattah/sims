<!DOCTYPE html>
<!-- version v3.0.0 -->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CDN Information Integration System">
    <meta name="author" content="Qbitgroup Software">
    <meta name="keyword" content="SST">
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
</head>

<body class="c-app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        @yield('content')
        <div class="col-12">
            <hr/>
            <div class="card-group">
                <div class="p-3">
                    <nav class="nav flex-column">
                        <a class="nav-link disabled p-0 pb-1" href="javascript:void(0)" style="font-weight: 700">Application</a>
                        <a class="nav-link p-0" target="_blank" href="http://www.customs.gov.my/en/uc">uCUSTOMS System</a>
                        <a class="nav-link p-0" target="_blank" href="https://www.myttx.customs.gov.my/">MyTTx (Tourism Tax)</a>
                        <a class="nav-link p-0" target="_blank" href="https://mydlv.customs.gov.my/">MyDLv (Levi Pelepasan)</a>
                        <a class="nav-link p-0" target="_blank" href="http://gst.customs.gov.my/en/Pages/default.aspx">GST (Good and Service Tax)</a>
                        <a class="nav-link p-0" target="_blank" href="https://gst.customs.gov.my/TAP/_/">TAP (Tax Payer Access Point)</a>
                        <a class="nav-link p-0" target="_blank" href="https://mysst.customs.gov.my/">MySST (Sales and Service Tax)</a>
                        <a class="nav-link p-0" target="_blank" href="http://customsgc.gov.my/index_aeo.html">AEO (Authorised Economic Operator)</a>
                    </nav>
                </div>
                <div class="p-3">
                    <nav class="nav flex-column">
                        <a class="nav-link disabled p-0 pb-1" href="javascript:void(0)" style="font-weight: 700">Services</a>
                        <a class="nav-link p-0" target="_blank" href="http://customsgc.gov.my/">AEO (Authorized Economic Operator)</a>
                        <a class="nav-link p-0" target="_blank" href="https://webcor.customs.gov.my/">WebCOR (Customes Official Receipt)</a>
                        <a class="nav-link p-0" target="_blank" href="http://aduan.customs.gov.my/aduanawam/">e-Aduan (Complaint System)</a>
                        <a class="nav-link p-0" target="_blank" href="http://mysstext.customs.gov.my/tariff/">HS-Explorer</a>
                        <a class="nav-link p-0" target="_blank" href="http://sppa.customs.gov.my/">SPPA (Assets Management System)</a>
                        <a class="nav-link p-0" target="_blank" href="http://tariff.customs.gov.my/FOREX/">Forex</a>
                    </nav>
                </div>
                <div class="p-3">
                    <nav class="nav flex-column">
                        <a class="nav-link disabled p-0 pb-1" href="javascript:void(0)" style="font-weight: 700">Agency</a>
                        <a class="nav-link p-0" target="_blank" href="https://www.malaysia.gov.my/">Portal Rasmi Kerajaan Malaysia (MyGov)</a>
                        <a class="nav-link p-0" target="_blank" href="http://www.mpc.gov.my/">Perbadanan Produktiviti Malaysia (MPC)</a>
                        <a class="nav-link p-0" target="_blank" href="http://tribunalkastam.treasury.gov.my/?bahasa=malay&m=">Tribunal Rayuan Kastam</a>
                        <a class="nav-link p-0" target="_blank" href="http://www.treasury.gov.my/index.php?lang=ms">Kementerian Kewangan Malaysia (MOF)</a>
                        <a class="nav-link p-0" target="_blank" href="http://www.mytradelink.gov.my/epermitinfo">Portal Rasmi Untuk Fasilitasi Perdagangan (MyTRADELINK)</a>
                        <a class="nav-link p-0" target="_blank" href="http://mytraderepository.customs.gov.my/en/Pages/default.aspx">Malaysia National Trade Repository (MNTR)</a>
                        <a class="nav-link p-0" target="_blank" href="http://www.mygovmobile.malaysia.gov.my/web/">MyGov Mobile</a>
                        <a class="nav-link p-0" target="_blank" href="http://asw.asean.org/">ASEAN Single Window (ASW)</a>
                        <a class="nav-link p-0" target="_blank" href="http://clikc.wcoomd.org/">WCO Customs Learning and Knowledge Community (CLiKC)</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-right pt-2">
                    <span class="font-size: 10pt">V2020.1</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{!! asset('js/jquery.min.js') !!}"></script>
<script src="{!! asset('js/moment-with-locales.min.js') !!}"></script>
<script src="{!! asset('js/app1.min.js') !!}"></script>
<script src="{!! asset('js/app2.js') !!}"></script>
<script src="{!! asset('js/coreui.bundle.min.js') !!}"></script>
<!--[if IE]><!-->
<script src="{!! asset('js/svgxuse.min.js') !!}"></script>
<!--<![endif]-->
</body>

</html>