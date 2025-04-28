<x-app-layout>

    <section class="section">
        <div class="block w-10 detail">

            @include('pages.photos.components.header')

            @include('pages.photos.components.detail-pagination')

            <div class="detail__img-block mb-2">
                <img src="{{ Storage::url('images/photos/' . $photo->photo) }}" alt="{{ $photo->title  }}" />
            </div>
           
            <p class="detail__description mb-1">{{ $photo->description }}</p>

            @include('pages.photos.components.detail-pagination') 
        </div>
    </section>
  
</x-app-layout>
