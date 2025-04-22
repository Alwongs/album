<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    protected $emailSuffix = '@friend.fr';
    protected $auth;

    public function __construct()
    {
        $this->auth = Auth::user();
    }

    public function generateAccessLink()
    {
        $name = 'Friend_' . time();
        $login = 'Fr_' . time();
        $email = $login . $this->emailSuffix;
        $password = 'gf452' . time() + 54613586874 . '45dhy848';
        $appUrl = config('app.url');

        $user = User::create([
            'name'     => $name,
            'email'    => $email ,
            'password' => $password,
            'role'     => 'F',
            'followed_id' => $this->auth->id
        ]);

        return url('/link-for-friend', ['login' => $login, 'password' => $password]);
    }

    public function loginFriend($login, $password)
    {
        $email = $login . $this->emailSuffix;

        $user = User::where('email', $email )->first();

        if (!$user) {
            return 'Link is invalid!';
        }

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            Auth::login($user);
            return redirect(route('home', absolute: false));
        }
    }
}
