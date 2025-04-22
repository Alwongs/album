<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="header">
        {{ $category->title  }}
    </x-slot>

    <div class="btn-block-x-end mb-5">
        <a href="{{ route('photos.create', ['category_id' => $category->id]) }}" class="btn btn-blue">Add Photo</a>
    </div>

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
