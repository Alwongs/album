<div class="top-panel__false-layer mb-1"></div>

<div class="top-panel">
    <div id="top-panel-menu-opener" class="top-panel__menu-opener">
        <x-icon-menu />
    </div>


    {{-- <div class="top-panel__search">
        <a class="top-panel__search-icon" href="{{ route('search-photos') }}">
            <x-icon-search />
        </a>
    </div> --}}

    <div id="top-panel-auth-opener" class="top-panel__auth-opener">
        @Auth
            <div class="top-panel__auth-icon">
                <x-icon-search />
            </div>
        @else
            Not authorized
        @endif
    </div>
</div>

@include('layouts.left-side')

@include('layouts.right-side')