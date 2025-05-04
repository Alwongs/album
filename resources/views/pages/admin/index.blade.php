<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <header class="header">
        <h1>{{ __('Administration') }}</h1>
    </header>

    <section class="section">
        <div class="block w-8 ">
            <div class="user-detail-element mb-2">
                <span class="user-detail-element__key">Photo count: </span>
                <span class="user-detail-element__value">{{ $photoCount }}</span>
            </div>
        </div>
    </section>
    
</x-app-layout>