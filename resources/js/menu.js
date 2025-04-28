// Меню бургер
const openMenuBtn = document.querySelector('#top-panel-menu-opener');
const closeMenuBtn = document.querySelector('#left-side-closer');
const leftSide = document.querySelector('#left-side');

if (openMenuBtn) {
    openMenuBtn.addEventListener("click", function(e) {
        leftSide.classList.toggle('_active');
    })
}

if (closeMenuBtn) {
    closeMenuBtn.addEventListener("click", function(e) {
        leftSide.classList.toggle('_active');
    })
}