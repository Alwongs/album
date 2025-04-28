<div class="top-panel__false-layer mb-1"></div>

<div class="top-panel">
    <p id="top-panel-menu-opener" class="top-panel__menu-opener">Menu</p>

    <p id="top-panel-auth-opener" class="top-panel__auth-opener">
        @Auth
            {{ Auth::user()->name }}
        @else
            Auth
        @endif
    </p>
</div>

@include('layouts.left-side')

@include('layouts.right-side')