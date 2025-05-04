<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;

class AdminController extends Controller
{
    public function index()
    {
        $photoCount = Photo::where('user_id', Auth::user()->id)->count();

        return view('pages.admin.index', compact('photoCount'));
    }
}
