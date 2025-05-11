@if($previousPhoto)
    <div class="detail-image-block__pagination-link left">
        <a href="{{ route('photos.show', $previousPhoto->id) }}" class="detail-image-block__pagination-icon">
            <x-icon-arrow-back />
        </a>
    </div>
@endif

@if($nextPhoto)
    <div class="detail-image-block__pagination-link right">
        <a href="{{ route('photos.show', $nextPhoto->id) }}" class="detail-image-block__pagination-icon">
            <x-icon-arrow-forward />
        </a>                    
    </div>
@endif