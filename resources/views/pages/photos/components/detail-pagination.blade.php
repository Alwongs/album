<div class="detail__pagination mb-1">
    @if($previousPhoto)
        <a
            class="detail__pagination-link"
            href="{{ route('photos.show', $previousPhoto->id) }}"
        >
        <x-icon-arrow-back-blue />
        </a>                    
    @else
        <p> </p>
    @endif

    @if($nextPhoto)
        <a
            class="detail__pagination-link"
            href="{{ route('photos.show', $nextPhoto->id) }}"
        >
            <x-icon-arrow-forward-blue />
        </a>
    @else
        <p> </p>
    @endif
</div>   