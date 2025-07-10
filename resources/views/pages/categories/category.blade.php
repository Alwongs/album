<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('pages.categories.components.header')

    <section class="section">
        <div class="block w-8 category-photos">

            @if($category->photos)
                @foreach ($category->photos as $photo)
                    @include('pages.categories.components.category-photos-item')
                @endforeach
            @else
                <p>no data</p>
            @endif
        </div>
    </section>

    @include('pages.categories.components.photo-modal')

</x-app-layout>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('photoModal');
        const modalImage = document.getElementById('modalImage');
        const modalClose = document.getElementById('modalClose');
        
        const modalArrowLeft = document.getElementById('modalArrowLeft');
        const modalArrowRight = document.getElementById('modalArrowRight');

        const basePhotoPath = "{{ Storage::url('images/photos/') }}";

        const photos = @json($category->photos);
        const photosReverse = [...photos].reverse();

        let currentId = 0;

        document.querySelectorAll('.category-photos-item__img-block').forEach(img => {
            img.addEventListener('click', function () {
                const img = this.querySelector('img');
                modalImage.src = img.dataset.full;
                modal.style.display = 'flex';
                currentId = Number(img.dataset.id);
            });
        });

        modalClose.addEventListener('click', function () {
            modal.style.display = 'none';
            modalImage.src = '';
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                modalImage.src = '';
            }
        });

        modalArrowLeft.addEventListener('click', function(e) {
            const previousPhoto = getPreviousPhoto(photosReverse, currentId);
            modalImage.src = basePhotoPath + previousPhoto.photo;
            currentId = Number(previousPhoto.id);
        });

        modalArrowRight.addEventListener('click', function(e) {
            const nextPhoto = getNextPhoto(photos, currentId);
            modalImage.src = basePhotoPath + nextPhoto.photo;
            currentId = Number(nextPhoto.id);
        });
    });

    function getNextPhoto(array, curId) {
        for (let photo of array) {
            if (photo.id > curId) {
                return {
                    id: photo.id,
                    photo: photo.photo
                } 
            }
        }
        return {
            id: array[0].id,
            photo: array[0].photo
        }
    }

    function getPreviousPhoto(array, curId) {
        for (let photo of array) {
            if (photo.id < curId) {
                return {
                    id: photo.id,
                    photo: photo.photo
                } 
            }
        }
        return {
            id: array[0].id,
            photo: array[0].photo
        }
    }
</script>