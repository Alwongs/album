<script>
    document.addEventListener('DOMContentLoaded', function () {
        const preloader = document.getElementById('preloader');

        const modal = document.getElementById('photoModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const modalImage = document.getElementById('modalImage');
        const modalClose = document.getElementById('modalClose');
        const modalArrowLeft = document.getElementById('modalArrowLeft');
        const modalArrowRight = document.getElementById('modalArrowRight');

        const basePhotoPath = "{{ Storage::url('images/photos/') }}";
        const photos = @json($photos);
        const photosReverse = [...photos].reverse();
        let currentId = 0;

        document.querySelectorAll('.category-photos-item__img-block').forEach(img => {
            img.addEventListener('click', function () {
                const img = this.querySelector('img');
                modalImage.src = img.dataset.full;
                modalTitle.textContent = img.dataset.title;
                modalDescription.textContent = img.dataset.description;
                modal.style.display = 'flex';
                currentId = Number(img.dataset.id);
            });
        });

        let startX = 0;
        let endX = 0;

        modalImage.addEventListener('touchstart', function(e) {
            startX = e.changedTouches[0].clientX;
        });

        modalImage.addEventListener('touchend', function(e) {
            endX = e.changedTouches[0].clientX;
            handleSwipe();
        });      

        modalClose.addEventListener('click', function () {
            closeModal();
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        modalArrowLeft.addEventListener('click', function(e) {
            const previousPhoto = getPreviousPhoto(photosReverse, currentId);
            animateSwipe('left', basePhotoPath + previousPhoto.photo, previousPhoto.title, previousPhoto.description)
            // setPhotoAttributes(basePhotoPath + previousPhoto.photo, previousPhoto.title, previousPhoto.description)
            currentId = Number(previousPhoto.id);
        });

        modalArrowRight.addEventListener('click', function(e) {
            const nextPhoto = getNextPhoto(photos, currentId);
            animateSwipe('right', basePhotoPath + nextPhoto.photo, nextPhoto.title, nextPhoto.description)
            // setPhotoAttributes(basePhotoPath + nextPhoto.photo, nextPhoto.title, nextPhoto.description)
            currentId = Number(nextPhoto.id);
        });

        function closeModal() {
            modal.style.display = 'none';
            clearPhotoAttributes();
        }

        function clearPhotoAttributes() {
            modalImage.src = '';
            modalTitle.textContent = '';
            modalDescription.textContent = '';
        }

        function setPhotoAttributes(src, title, description) {
            modalImage.src = src;
            modalTitle.textContent = title;
            modalDescription.textContent = description;            
        }

        function handleSwipe() {
            const diffX = endX - startX;
            const threshold = 50; // минимальное расстояние для свайпа

            if (Math.abs(diffX) > threshold) {
                if (diffX > 0) {
                    const nextPhoto = getNextPhoto(photos, currentId);
                    animateSwipe('right', basePhotoPath + nextPhoto.photo, nextPhoto.title, nextPhoto.description)
                    currentId = Number(nextPhoto.id);
                } else {
                    const previousPhoto = getPreviousPhoto(photosReverse, currentId);
                    animateSwipe('left', basePhotoPath + previousPhoto.photo, previousPhoto.title, previousPhoto.description)
                    currentId = Number(previousPhoto.id);
                }
            }
        }
        
        function animateSwipe(direction, newSrc, newTitle, newDescription) {
            showPreloader();
            preloadImage(newSrc).then(() => {
                hidePreloader();
                modalImage.classList.remove('slide-reset');
                modalImage.classList.add(direction === 'left' ? 'slide-left' : 'slide-right');

                // после окончания перехода меняем фото и убираем сдвиг
                modalImage.addEventListener('transitionend', function handler() {
                    modalImage.removeEventListener('transitionend', handler);
                    setPhotoAttributes(newSrc, newTitle, newDescription)
                    modalImage.classList.remove('slide-left', 'slide-right');
                    modalImage.classList.add('slide-reset');
                }, { once: true });
            }).catch(() => {
                hidePreloader();
                console.warn('Ошибка загрузки изображения:', newSrc);
            });
        }
        
        function preloadImage(src) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(src);
                img.onerror = reject;
                img.src = src;
            });
        }  
        
        function getNextPhoto(array, curId) {
            for (let photo of array) {
                if (photo.id > curId) {
                    return photo;
                }
            }
            return array[0];
        }

        function getPreviousPhoto(array, curId) {
            for (let photo of array) {
                if (photo.id < curId) {
                    return photo;
                }
            }
            return array[0];
        }

        function showPreloader() {
            preloader.style.display = 'block';
        }

        function hidePreloader() {
            preloader.style.display = 'none';
        }        
    });
</script>