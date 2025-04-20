<x-app-layout>

    <x-slot name="header">
        {{ __('Edit: ') }} {{ $photo->title }}
    </x-slot>

    <section class="section">
        <div class="block w-3">
            <x-input-error class="mb-2" :messages="$errors->all()"/>

            <form class="form" action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="input-block">
                    <input class="text-center" type="text" name="title" value="{{ $photo->title }}" placeholder="Title" />
                </div>

                <div class="textarea-block">
                    <textarea class="" name="description" value="{{ $photo->description }}" placeholder="Description"></textarea>
                </div>                

                <div class="submit-block">
                    <input class="btn btn-green" type="submit" value="Update">
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
