<x-app-layout>

    <section class="section">
        <div class="block w-11 detail">

            @include('pages.photos.components.header')

            <div class="detail__img-block detail-image-block mb-1" >
                <img src="{{ Storage::url('images/photos/' . $photo->photo) }}" alt="{{ $photo->title  }}" />

                @include('pages.photos.components.detail-pagination') 
            </div>

            <h2 class="detail__title mb-2">{{ $photo->title  }}</h2>
            
            <p class="detail__description mb-1">{{ $photo->description }}</p>

        </div>
    </section>
  
</x-app-layout>
