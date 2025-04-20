@props(['messages'])

@if ($messages)
    <ol {{ $attributes->merge(['class' => 'notification notification-error']) }}>
        @foreach ((array) $messages as $message)
            <li class="notification__item">{{ $message }}</li>
        @endforeach
    </ol>
@endif
