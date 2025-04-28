<div class="breadcrumbs">
    @isset($users)
        <h3 class="breadcrumbs__title">
            {{ __('Users')  }}
        </h3>
    @else
        <a class="breadcrumbs__link" href="{{ route('users.index') }}">
            {{ __('Users') }}:
        </a>
        <h3 class="breadcrumbs__title">
            "{{ $user->name  }}"
        </h3>
    @endisset
</div>