<div class="top-panel__false-layer mb-1"></div>

<div class="top-panel">
    <div id="top-panel-menu-opener" class="top-panel__menu-opener">
        <x-icon-menu />
    </div>


    <div class="top-panel__search">
        {{-- <div class="top-panel__search-input">
            <input type="text">
        </div> --}}
        <a class="top-panel__search-icon" href="{{ route('search-photos') }}">
            <x-icon-search />
        </a>
    </div>

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