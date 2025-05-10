<aside id="left-side" class="left-side">
    <div class="left-side__top-btn-block mb-2">
        <button id="left-side-closer" class="left-side__close-btn">
            <x-icon-close />
        </button>
    </div>

    <h2 class="left-side__title">Navigation</h2>

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