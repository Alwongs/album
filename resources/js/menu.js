// Navigation menu
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
        leftSide.classList.remove('_active');
    })
}

// Auth
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