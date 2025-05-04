<header class="header">
    @include('pages.photos.components.breadcrumbs')

    @if($isAdmin)
        <div id="photo-detail-actions-opener" class="photo-detail-actions-opener">
            <x-icon-actions />
        </div>
    @endif

    @include('pages.photos.components.actions-modal')

</header>
