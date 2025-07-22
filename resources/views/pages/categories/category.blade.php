<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('pages.categories.components.header')

    <section class="section">

        <div class="block-category-navigation-container">
            <nav class="block block-category-navigation">
                @foreach ($categories as $link)
                    <a href="{{ route('categories.show', $link->id) }}" class="block-category-navigation__link {{ $link->id == $category->id ? 'current' : '' }}">
                        {{ $link->title }}
                    </a>
                @endforeach
            </nav>
            <div class="scroll-hint">Проведите пальцем влево, чтобы увидеть больше →</div>
        </div>

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

    @include('pages.categories.components.photo-modal')

</x-app-layout>

@include('pages.categories.js.script', ['photos' => $category->photos])
