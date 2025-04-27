@props(['disabled' => false, 'messages' => [], 'class' => ''])


<div class="auth-form-element {{ $class }}">

    <div class="auth-form-input-block">
        <input @disabled($disabled) {{ $attributes->merge(['class' => 'auth-form-input']) }} >
    </div>

    <x-input-error :messages="$messages" />
</div>

