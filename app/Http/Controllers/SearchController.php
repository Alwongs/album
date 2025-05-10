<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;

class SearchController extends Controller
{
    protected $auth;
    protected $isAdmin;

    public function __construct()
    {
        $this->auth = Auth::user();
        $this->isAdmin = Auth::user()->role == 'A' ? true : false;
    }


    public function index()
    {
        return view('pages.photos.search');
    }

    public function find(Request $request)
    {
        $search_text = $request->query('search_text');

        $photos = Photo::where('description', 'LIKE', '%' . $search_text . '%')
            ->orWhere('title', 'LIKE', '%' . $search_text . '%')
            ->get();

        $isAdmin = $this->isAdmin;

        return view('pages.photos.search', compact('photos', 'isAdmin'));
    }
}
