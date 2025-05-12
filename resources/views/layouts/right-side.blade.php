<aside id="right-side" class="right-side">
    <div class="right-side__false-layer mb-2"></div>

    <form class="right-side-search mb-2" action="{{ route('find-photos') }}" method="GET">
        <div class="right-side-search__input-block">
            <input type="text" name="search_text">
        </div>
        <button class="right-side-search__submit" type="submit">Find</button>
    </form>


    <div class="right-side__bottom-btn-block">
        <button id="right-side-closer" class="right-side__close-btn">
            <x-icon-close />
        </button>
    </div>    
</aside>




