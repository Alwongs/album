<aside id="left-side" class="left-side">
    <div class="left-side__top-btn-block">
        <button id="left-side-closer" class="left-side__close-btn">
            <x-icon-close />
        </button>
    </div>


    <nav class="auth-navigation mb-2">     
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

    <nav class="left-side__navigation navigation">
        @auth
            <a href="{{ route('categories.index') }}" class="navigation__link">Album</a>
        @endauth
        
        <a href="{{ route('about') }}" class="navigation__link">About</a>  
        
        @if(Auth::user() && Auth::user()->is_root)    
            <a href="{{ route('users.index') }}" class="navigation__link">Users</a>  
            <a href="{{ route('admin') }}" class="navigation__link">Administration</a>  
        @endif  
      
    </nav>

  
</aside>