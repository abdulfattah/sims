<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Home') c-active @endif" href="{!! URL::to('/') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-speedometer') !!}"></use>
        </svg> Dashboard
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Company') c-active @endif" href="{!! URL::to('company') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-tags') !!}"></use>
        </svg> Companies
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="#" target="_blank">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-book') !!}"></use>
        </svg> User Manual
    </a>
</li>