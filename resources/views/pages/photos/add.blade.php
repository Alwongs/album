<x-app-layout>

    <x-slot name="header">
        {{ __('New photo for album: ') }} <span class="header-param">{{ $category->title }}</span>
    </x-slot>

    <section class="section">
        <div class="block w-3">
            <x-input-error class="mb-2" :messages="$errors->all()"/>

            <form class="form" action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="category_id" value="{{ $category->id }}" />

                <div class="input-block">
                    <input class="text-center" type="text" name="title" placeholder="Title" required />
                </div>

                <div class="input-block">
                    <select class="text-center" type="text" name="access" placeholder="Access">
                        @foreach($accesses as $key => $title)
                            <option
                                @if($key == 'F') selected @endif
                                value="{{ $key }}"
                            >
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="file" name="image" required>

                <div class="textarea-block">
                    <textarea class="" name="description" placeholder="Description"></textarea>
                </div>                

                <div class="submit-block">
                    <input class="btn btn-green" type="submit" value="Save">
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
