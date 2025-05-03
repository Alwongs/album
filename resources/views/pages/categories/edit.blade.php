<x-app-layout>

    <x-slot name="header">
        {{ __('Edit: ') }} {{ $category->title }}
    </x-slot>

    <section class="section">
        <div class="block w-3">
            <x-input-error class="mb-2" :messages="$errors->all()"/>

            <form class="form" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="input-block">
                    <input class="text-center" type="text" name="title" value="{{ $category->title }}" placeholder="Title" required />
                </div>               

                <div class="submit-block">
                    <input class="btn btn-green" type="submit" value="Update">
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
