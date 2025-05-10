<x-app-layout>

    @include('pages.photos.components.form-header')

    <section class="section">
        <div class="block w-3">
            <x-input-error class="mb-2" :messages="$errors->all()"/>

            <form class="form" action="{{ route('photos.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="input-block">
                    <input class="text-center" type="text" name="title" value="{{ $photo->title }}" placeholder="Title" required />
                </div>

                <div class="input-block">
                    <select class="text-center" type="text" name="access" placeholder="Access">
                        @foreach($accesses as $key => $title)
                            <option
                                @if($key == $photo->access) selected @endif
                                value="{{ $key }}"
                            >
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="textarea-block">
                    <textarea class="" name="description" placeholder="Description">{{ $photo->description }}</textarea>
                </div>                

                <div class="submit-block">
                    <input class="btn btn-green" type="submit" value="Update">
                </div>
            </form>
        </div>
    </section>

</x-app-layout>
