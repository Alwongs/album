<div class="category-photos-item">
    @if($isAdmin)
        <header class="category-photos-item__header">
            <a class="category-photos-item__edit-btn" href="{{ route('photos.edit', $photo->id) }}">Edit</a>
            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="category-photos-item__del-btn" type="submit">
                    Delete
                </button>
            </form>
        </header>
    @endif
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


