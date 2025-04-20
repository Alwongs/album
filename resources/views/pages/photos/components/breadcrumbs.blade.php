<div class="breadcrumbs">
    <a class="breadcrumbs__link" href="{{ route('categories.show', $photo->category_id) }}">
        {{ $photo->category->title }}:
    </a>
    <h3 class="breadcrumbs__title">
        "{{ $photo->title  }}"
    </h3>
</div>