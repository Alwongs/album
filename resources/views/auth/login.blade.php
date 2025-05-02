<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="auth-header mb-1">
        {{ __('Login') }}
    </h1>

    <section class="section">
        <form class="auth-form block w-3" method="POST" action="{{ route('login') }}">
            @csrf

            <x-auth-form-element
                class="mb-2"
                type="email"
                name="email"
                placeholder="Email"
                :value="old('email')"
                :messages="$errors->get('email')" 
                autofocus
                autocomplete="username" 
                required
            />

            <x-auth-form-element
                class="mb-3"
                type="password"
                name="password"
                placeholder="Password"
                autocomplete="current-password"
                :messages="$errors->get('password')"  
                required         
            />            
    
            <!-- Remember Me -->
            <div class="mb-4">
                <label for="remember_me" class="">
                    <input id="remember_me" type="checkbox" class="auth-form-remember-input" name="remember">
                    <span class="auth-form-remember-label">{{ __('Remember me') }}</span>
                </label>
            </div>
    
            <div class="auth-form-btn-block">
                @if (Route::has('password.request'))
                    <a class="auth-form-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
    
                <x-submit-button class="">
                    {{ __('Log in') }}
                </x-submit-button>
            </div>
        </form>
    </section>

</x-guest-layout>
