<header class="header">
    @include('pages.photos.components.breadcrumbs')

    @if($isAdmin)
        {{-- <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-blue">Edit</a> --}}

        <p id="photo-detail-actions-opener" class="photo-detail-actions-opener">[actions]</p>
    @endif

    <div id="photo-detail-actions-modal" class="photo-detail-actions-modal">
        <a href="{{ route('photos.edit', $photo->id) }}" class="photo-detail-actions-modal__edit">Edit</a>
        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="photo-detail-actions-modal__delete" type="submit">
                Delete
            </button>
        </form>   
    </div>
</header>