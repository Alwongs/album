<header class="header">
    @include('pages.users.components.breadcrumbs')

    @isset($users)
        <a href="{{ route('users.create') }}" class="btn btn-blue">Create user and link</a>
    @endisset
</header>