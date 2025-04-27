<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="header">
        {{ __("available photos for guests") }}
    </x-slot>

    <section class="section">
        <div class="block w-8 category-photos">

            @if($photos)
                @foreach ($photos as $photo)
                    @include('pages.home.components.all-photos-item')
                @endforeach
            @else
                <p>no data</p>
            @endif
        </div>
    </section>

</x-app-layout>
