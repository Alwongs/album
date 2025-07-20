<div class="category-photos-item">
    @if($isAdmin)
        <header class="category-photos-item__header">
            <a class="category-photos-item__edit-btn" href="{{ route('photos.edit', $photo->id) }}">Edit</a>

            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST"  onsubmit="return confirmDelete();">
                @csrf
                @method('DELETE')
                <button class="category-photos-item__del-btn" type="submit">
                    Delete
                </button>
            </form>
        </header>
    @endif

    <div class="category-photos-item__img-block">
        <img
            src="{{ Storage::url('images/previews/' . $photo->photo) }}"
            alt="{{ $photo->title  }}"
            loading="lazy"
            class="category-photo-item"
            data-full="{{ Storage::url('images/photos/' . $photo->photo) }}"
            data-id="{{ $photo->id }}"
            data-title="{{ $photo->title }}"
            data-description="{{ $photo->description }}"
            style="cursor: pointer;"            
        />      
    </div>

    <footer class="category-photos-item__footer">
        <h2 class="category-photos-item__title">
            {{ $photo->title }}
        </h2>
    </footer>

    @if($photo->access == 'A')
        <p class="category-photos-item__label label-admin">{{ $photo->access }}</p>
    @elseif($photo->access == 'F')
        <p class="category-photos-item__label label-friend">{{ $photo->access }}</p>
    @endif
</div>

<script>
    function confirmDelete() {
        return confirm("Вы уверены, что хотите удалить это фото?");
    }
</script>
