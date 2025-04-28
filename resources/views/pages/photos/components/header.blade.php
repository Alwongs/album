<header class="header">
    @include('pages.photos.components.breadcrumbs')

    @if($isAdmin)
        <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-blue">Edit</a>
    @endif
</header>