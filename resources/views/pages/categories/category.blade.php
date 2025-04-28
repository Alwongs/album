<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('pages.categories.components.header')

    <section class="section">
        <div class="block w-8 category-photos">

            @if($category->photos)
                @foreach ($category->photos as $photo)
                    @include('pages.categories.components.category-photos-item')
                @endforeach
            @else
                <p>no data</p>
            @endif
        </div>
    </section>

</x-app-layout>
