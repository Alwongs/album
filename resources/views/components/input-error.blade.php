@props(['messages'])

@if ($messages)
    <ol {{ $attributes->merge(['class' => 'auth-input-error']) }}>
        @foreach ((array) $messages as $message)
            <li class="">{{ $message }}</li>
        @endforeach
    </ol>
@endif
