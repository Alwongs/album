<x-app-layout>
    <x-slot name="header">
        {{ __('New user') }}
    </x-slot>

    <section class="section">
        <div class="block w-2">
            <x-input-error class="mb-2" :messages="$errors->all()"/>

            <form class="form" action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="input-block">
                    <input class="text-center" type="text" name="name" placeholder="Name" required />
                </div>

                <div class="submit-block">
                    <input class="btn btn-green" type="submit" value="Save">
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
