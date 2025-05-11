<div class="detail__pagination mb-1">
    @if($previousPhoto)
        <a
            class="detail__pagination-link"
            href="{{ route('photos.show', $previousPhoto->id) }}"
        >
            <div class="detail__pagination-icon">
                <x-icon-arrow-back-blue />
            </div>
        </a>                    
    @else
        <p> </p>
    @endif

    @if($nextPhoto)
        <a
            class="detail__pagination-link"
            href="{{ route('photos.show', $nextPhoto->id) }}"
        >
            <div class="detail__pagination-icon">
                <x-icon-arrow-forward-blue />
            </div>
        </a>
    @else
        <p> </p>
    @endif
</div>   