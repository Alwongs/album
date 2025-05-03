<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <header class="header">
        <h1>{{ __('Years') }}</h1>

        @if($isAdmin)
            <a href="{{ route('categories.create') }}" class="btn btn-blue">Add Year</a>
        @endif
    </header>

    <section class="section">
        <div class="block w-8 categories">
            @foreach ($categories as $category)
                <div class="categories-item">
                    <a href="{{ route('categories.show', $category->id) }}" class="categories-item__link">
                        <div class="categories-item__title">
                            {{ $category->title }}
                        </div>
                    </a>
                    @if($isAdmin)
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button class="categories-item__del" type="submit">
                                &times;
                            </button>
                        </form>
                        <a class="categories-item__edit" href="{{ route('categories.edit', $category->id) }}">
                            &#9998;
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    
</x-app-layout>

<script>
    function confirmDelete() {
        return confirm("Вы уверены, что хотите удалить это фото?");
    }
</script>
