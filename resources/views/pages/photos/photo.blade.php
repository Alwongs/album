<x-app-layout>

    <section class="section">
        <div class="block w-11 detail">

            @include('pages.photos.components.header')

            <div class="detail__img-block detail-image-block mb-1" >
                <div class="image-header">
                    <h2 class="image-header__title mb-2">{{ $photo->title  }}</h2>
                </div>

                <img src="{{ Storage::url('images/photos/' . $photo->photo) }}" alt="{{ $photo->title  }}" />

                @include('pages.photos.components.detail-pagination') 
            </div>

            <p class="detail__description mb-1">{{ $photo->description }}</p>

        </div>
    </section>
  
</x-app-layout>
