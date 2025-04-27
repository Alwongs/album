<div class="top-panel">
    <div class="logo">
        <a href="{{ route('home') }}" class="navigation__link">Home</a>
    </div>

    <nav class="navigation">
        <a href="{{ route('categories.index') }}" class="navigation__link">Album</a>
        @if(Auth::user() && Auth::user()->is_root)    
            <a href="{{ route('users.index') }}" class="navigation__link">Users</a>  
        @endif
        <a href="{{ route('about') }}" class="navigation__link">About</a>      
    </nav>

    @auth
        <div class="auth">
            <a class="auth__name" href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>
            <form class="auth__logout" method="POST" action="{{ route('logout') }}">
                @csrf
                <a
                    class="auth__logout"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    {{ __('Logout') }}
                </a>
            </form>
        </div>
    @endauth
</div>