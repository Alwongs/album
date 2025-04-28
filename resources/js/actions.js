const phototDetailActionsOpener = document.querySelector('#photo-detail-actions-opener');
const phototDetailActionsModal = document.querySelector('#photo-detail-actions-modal');

if (phototDetailActionsOpener) {
    phototDetailActionsOpener.addEventListener("click", function(e) {
        phototDetailActionsModal.classList.toggle('_active');
    })
}
