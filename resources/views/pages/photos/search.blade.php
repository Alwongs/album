<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('pages.photos.components.search-header')

    <section class="section">
        <div class="block w-8 category-photos">

            @isset($photos)
                @foreach ($photos as $photo)
                    @include('pages.categories.components.category-photos-item')
                @endforeach
            @else
                <p>no data</p>
            @endisset
        </div>
    </section>

</x-app-layout>
