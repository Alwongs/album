<header class="header">
    @include('pages.categories.components.breadcrumbs')

    @if($isAdmin)
        <a href="{{ route('photos.create', ['category_id' => $category->id]) }}" class="btn btn-blue">Add Photo</a>
    @endif
</header>