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
                <a href="{{ route('categories.show', $category->id) }}" class="categories-item">
                    {{ $category->title }}
                    
                    @if($isAdmin)
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="categories-item__del" type="submit">
                                &times;
                            </button>
                        </form>
                    @endif
                </a>
            @endforeach
        </div>
    </section>


    
</x-app-layout>
