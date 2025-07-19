<div class="photo-modal" id="photoModal">
    
    <span class="photo-modal__close-btn" id="modalClose">&times;</span>

    <img
        class="photo-modal__img"
        id="modalImage"
        src=""
        alt="Full photo"
    />

    <span class="photo-modal__arrow-left" id="modalArrowLeft">
        <x-icon-arrow-back />
    </span>

    <span class="photo-modal__arrow-right" id="modalArrowRight">
        <x-icon-arrow-forward />
    </span>

    <div id="preloader" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none; z-index: 10;">
        <!-- Простой CSS-спиннер -->
        <div style="border: 4px solid rgba(255,255,255,0.2); border-top: 4px solid #fff; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite;"></div>
    </div>    
</div>


<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>