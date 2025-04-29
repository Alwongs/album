<header class="header">
    @include('pages.categories.components.breadcrumbs')

    @if($isAdmin)
        <a
            class="btn btn-blue"
            href="{{ route('photos.create', ['category_id' => $category->id]) }}"
        >
            Add
        </a>
    @endif
</header>