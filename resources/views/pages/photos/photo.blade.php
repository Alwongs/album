<x-app-layout>

    <section class="section">
        <div class="block w-10 photo-detail">

            @include('pages.photos.components.header')

            <div class="detail__img-block mb-2">
                <img src="{{ Storage::url('images/photos/' . $photo->photo) }}" alt="{{ $photo->title  }}" />
            </div>

            <p class="detail__description">{{ $photo->description }}</p>
        </div>
    </section>
  
</x-app-layout>
