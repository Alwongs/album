<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('pages.users.components.header')

    <section class="section">
        <div class="block w-8">

            <div class="user-detail-element mb-2">
                <span class="user-detail-element__key">Email: </span>
                <span class="user-detail-element__value">{{ $user->email }}</span>
            </div>

            <div class="user-detail-element mb-2">
                <span class="user-detail-element__key">Role: </span>
                <span class="user-detail-element__value">{{ $user->role }}</span>
            </div>   
            
            <div class="user-detail-element mb-2">
                <span class="user-detail-element__key">Root: </span>
                <span class="user-detail-element__value">{{ $user->is_root == 1 ? 'ROOT' : 'no' }}</span>
            </div>            
    
            @isset($link)
                <div class="user-detail-element">
                    <span class="user-detail-element__key">Link: </span>
                    <span class="user-detail-element__value">{{ $link}}</span>
                </div>
            @endisset
        </div>
    </section>
</x-app-layout>
