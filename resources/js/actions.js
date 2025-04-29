const phototDetailActionsOpener = document.querySelector('#photo-detail-actions-opener');
const phototDetailActionsCloser = document.querySelector('#photo-detail-actions-closer');
const phototDetailActionsModal = document.querySelector('#photo-detail-actions-modal');

if (phototDetailActionsOpener) {
    phototDetailActionsOpener.addEventListener("click", function(e) {
        phototDetailActionsModal.classList.toggle('_active');
    })
}
if (phototDetailActionsCloser) {
    phototDetailActionsCloser.addEventListener("click", function(e) {
        phototDetailActionsModal.classList.remove('_active');
    })
}