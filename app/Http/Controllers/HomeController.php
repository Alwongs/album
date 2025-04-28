<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Photo;

class HomeController extends Controller
{
    public function index()
    {
        $authRole = Auth::user() ? Auth::user()->role : false;
        $accessArray = ['G'];

        switch ($authRole) {
            case 'A':
                $accessArray = ['A', 'F', 'G'];
                break;
            case 'F':
                $accessArray = ['F', 'G'];
                break;
        }

        $photos = Photo::whereIn('access', $accessArray)->get();
        return view('pages.home.home', compact('photos'));
    }

}
