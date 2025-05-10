<aside id="right-side" class="right-side">
    <div class="right-side__false-layer mb-2"></div>

    

    <nav class="right-side__navigation auth-navigation">     
        <a
            class="auth-navigation__link"
            href="{{ route('profile.edit') }}"
        >
            {{ Auth::user() ? Auth::user()->name : 'No athorized' }}
        </a>
    
        @auth
            <form class="" method="POST" action="{{ route('logout') }}">
                @csrf
                <a
                    class="auth-navigation__link"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    {{ __('Logout') }}
                </a>
            </form>
        @endauth
    </nav>

    <div class="right-side__bottom-btn-block">
        <button id="right-side-closer" class="right-side__close-btn">
            <x-icon-close />
        </button>
    </div>    
</aside>




