<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $emailSuffix = '@friend.fr';
    protected $auth;

    public function __construct()
    {
        $this->auth = Auth::user();
    }

    public function index()
    {
        $users = User::all();
        return view('pages.users.users', compact('users'));
    }

    public function create()
    {
        return view('pages.users.add');
    }

    public function store(StoreUserRequest $request)
    {
        $name = $request->name;
        $login = $name . '_' . time();
        $email = $login . $this->emailSuffix;
        $password = 'gf452' . time() + 54613586874 . '45dhy848';
        // $appUrl = config('app.url');

        $user = User::create([
            'name'     => $name,
            'email'    => $email ,
            'password' => $password,
            'role'     => 'F',
            'followed_id' => $this->auth->id
        ]);

        $link = url('/link-for-friend', ['login' => $login, 'password' => $password]);

        return view('pages.users.user', compact('user', 'link'));
    }


    public function show(User $user)
    {
        return view('pages.users.user', compact('user'));
    }

    public function edit(User $user)
    {
    }

    public function update(UpdateUserRequest $request, User $user)
    {
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
