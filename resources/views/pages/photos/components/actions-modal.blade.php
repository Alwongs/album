<div id="photo-detail-actions-modal" class="photo-detail-actions-wrapper">

    <div class="photo-detail-actions-modal">
        <a href="{{ route('photos.edit', $photo->id) }}" class="photo-detail-actions-modal__edit">Edit</a>

        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirmDelete();">
            @csrf
            @method('DELETE')
            <button class="photo-detail-actions-modal__delete" type="submit">
                Delete
            </button>
        </form>   
    
        <button id="photo-detail-actions-closer" class="photo-detail-actions-modal__cancel">Cancel</button>
    </div>

</div>

<script>
    function confirmDelete() {
        return confirm("Вы уверены, что хотите удалить это фото?");
    }
</script>