<div class="detail__pagination mb-1">
    @if($previousPhoto)
        <a href="{{ route('photos.show', $previousPhoto->id) }}">« {{ __('Previous') }}</a>                    
    @else
        <p> </p>
    @endif

    @if($nextPhoto)
        <a href="{{ route('photos.show', $nextPhoto->id) }}">{{ __('Next') }} »</a>
    @else
        <p> </p>
    @endif
</div>   