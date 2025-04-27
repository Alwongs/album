<div class="category-photos-item">
    <a
        class="category-photos-item__img-block"
        href="{{ route('photos.show' , $photo->id) }}"
    >
        <img
            src="{{ Storage::url('images/previews/' . $photo->photo) }}"
            alt="{{ $photo->title  }}"
        />      
    </a>

    <footer class="category-photos-item__footer">
        <h2 class="category-photos-item__title">
            {{ $photo->title }}
        </h2>
    </footer>
</div>


