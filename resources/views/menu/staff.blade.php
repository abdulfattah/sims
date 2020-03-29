<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Home') c-active @endif" href="{!! URL::to('/') !!}">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-speedometer') !!}"></use>
        </svg> Dashboard
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link @if ($menu['menu'] == 'Tax') c-active @endif" href="{!! URL::to('tax') !!}?tab=1">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-tags') !!}"></use>
        </svg> Tax Records
    </a>
</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="#" target="_blank">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{!! asset('icons/free.svg#cil-book') !!}"></use>
        </svg> User Manual
    </a>
</li>