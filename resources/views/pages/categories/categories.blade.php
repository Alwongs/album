<x-app-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot name="header">
        {{ __('Years') }}
    </x-slot>

    @if($isAdmin)
        <div class="btn-block-x-end mb-5">
            <a href="{{ route('categories.create') }}" class="btn btn-blue">Add Year</a>
        </div>
    @endif

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
