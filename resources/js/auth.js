// Меню бургер
const openAuthBtn = document.querySelector('#top-panel-auth-opener');
const closeAuthBtn = document.querySelector('#right-side-closer');
const rightSide = document.querySelector('#right-side');

if (openAuthBtn) {
    openAuthBtn.addEventListener("click", function(e) {
        rightSide.classList.toggle('_active');
    })
}

if (closeAuthBtn) {
    closeAuthBtn.addEventListener("click", function(e) {
        rightSide.classList.remove('_active');
    })
}