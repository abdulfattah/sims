<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Home') c-active @endif" href="{!! URL::to('/') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-speedometer') !!}"></use>
        </svg> Dashboard
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'User') c-active @endif" href="{!! URL::to('user') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-people') !!}"></use>
        </svg> Users
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="#" target="_blank">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-book') !!}"></use>
        </svg> User Manual
    </a>
</li>