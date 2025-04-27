<button {{ $attributes->merge(['type' => 'submit', 'class' => 'auth-form-submit']) }}>
    {{ $slot }}
</button>
