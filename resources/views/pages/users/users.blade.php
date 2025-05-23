<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('pages.users.components.header') 

    <section class="section">
        <ul class="block w-6 users">
            @foreach ($users as $user)
                <li class="users-item">
                    <a href="{{ route('users.show', $user->id) }}" class="users-item__name">
                        {{ $user->name }}
                    </a> 
                    <p class="users-item__email">{{ $user->email }}</p>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="users-item__del" type="submit">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </section>
</x-app-layout>
