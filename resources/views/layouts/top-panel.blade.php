<div class="top-panel__false-layer mb-1"></div>

<div class="top-panel">
    <p id="top-panel-menu-opener" class="top-panel__menu-opener">
        <x-icon-menu />
    </p>




    <div id="top-panel-auth-opener" class="top-panel__auth-opener">
        @Auth
            <p class="top-panel__auth-label">
                {{ Auth::user()->name }}
            </p>
            <div class="top-panel__auth-icon">
                <x-icon-profile />
            </div>
        @else
            Auth
        @endif
    </div>
</div>

@include('layouts.left-side')

@include('layouts.right-side')