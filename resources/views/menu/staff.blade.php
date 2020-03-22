<ul class="nav">
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle @if ($menu['menu'] == 'Harta') active @endif" href="#">
            <i class="nav-icon fa fa-building-o"></i> Harta</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link pt-2 pb-2 @if ($menu['subMenu'] == 'Senarai Harta') active @endif" href="{!! URL::to('property') !!}" style="padding-left: 40px;">
                    Senarai Harta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-2 pb-2 @if ($menu['subMenu'] == 'Pemilik') active @endif" href="{!! URL::to('owner') !!}" style="padding-left: 40px">
                    Pemilik</a>
            </li>
        </ul>
    </li>
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle @if ($menu['menu'] == 'Penilaian') active @endif" href="#">
            <i class="nav-icon fa fa-calculator"></i> Penilaian</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item">
                <a class="nav-link pt-2 pb-2 @if ($menu['subMenu'] == 'Senarai Nilaian') active @endif" href="{!! URL::to('assessment/list') !!}" style="padding-left: 40px;">
                    Senarai Harta Dinilai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-2 pb-2 @if ($menu['subMenu'] == 'Kadar Nilaian') active @endif" href="{!! URL::to('rate/building') !!}" style="padding-left: 40px">
                    Kadar Nilaian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-2 pb-2 @if ($menu['subMenu'] == 'Kadar Cukai') active @endif" href="{!! URL::to('rate/tax') !!}" style="padding-left: 40px">
                    Kadar Cukai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-2 pb-2 @if ($menu['subMenu'] == 'Nilaian Berkelompok') active @endif" href="{!! URL::to('assessment/mass') !!}" style="padding-left: 40px">
                    Nilaian Berkelompok</a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link @if ($menu['menu'] == 'Tetapan') active @endif" href="{!! URL::to('edit/config/1') !!}">
            <i class="nav-icon icon-settings"></i> Tetapan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{!! env('SUPPORT_URL') . env('VERSION') . '/' . substr(SHA1(date('d-m-y H:i:s')), 0, 10) !!}" target="_blank">
            <i class="nav-icon icon-envelope"></i> Laporkan
        </a>
    </li>
</ul>


<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Home') c-active @endif" href="{!! URL::to('/') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-speedometer') !!}"></use>
        </svg> Dashboard
    </a>
</li>
<li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-speedometer') !!}"></use>
        </svg> Harta
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="buttons/buttons.html"><span class="c-sidebar-nav-icon"></span> Senarai Harta</a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="buttons/button-group.html"><span class="c-sidebar-nav-icon"></span> Pemilik</a>
        </li>
    </ul>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Users') c-active @endif" href="{!! URL::to('users') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-people') !!}"></use>
        </svg> Pengguna
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{!! env('SUPPORT_URL') . env('VERSION') . '/' . substr(SHA1(date('d-m-y H:i:s')), 0, 10) !!}" target="_blank">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-envelope-closed') !!}"></use>
        </svg> Laporkan
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="#" target="_blank">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-book') !!}"></use>
        </svg> Manual Pengguna
    </a>
</li>