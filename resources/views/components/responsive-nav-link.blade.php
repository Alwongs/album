@props(['active'])

@php
    $classes = ($active ?? false) ? 'active' : 'disable';
    $classes = $classes . ' navlink';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
