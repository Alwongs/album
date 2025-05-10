<header class="header">
    <div class="breadcrumbs">
        <a class="breadcrumbs__link" href="{{ route('categories.index') }}">
            {{ __('Albums') }}:
        </a>    
        <a class="breadcrumbs__link" href="{{ route('categories.show', $category->id) }}">
            {{ $category->title }}:
        </a>
        <h3 class="breadcrumbs__title">
            @isset($photo)
                "{{ $photo->title  }}"   
            @else
                "{{ __("New")  }}"
            @endisset
        </h3>
    </div>
</header>
