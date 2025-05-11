<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Photo;
use App\Http\Services\PhotoService;

class SearchController extends Controller
{
    protected $photoService;
    protected $auth;
    protected $isAdmin;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
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

        $userId = $this->auth->followed_id != 0 ? $this->auth->followed_id : $this->auth->id;

        $photos = Photo::where('user_id', $userId)
            ->where(function($query) use ($search_text) {
                $query->where('description', 'LIKE', '%' . $search_text . '%')
                    ->orWhere('title', 'LIKE', '%' . $search_text . '%');
            })
            ->get();

        $isAdmin = $this->isAdmin;
        if (!$isAdmin) {
            $photos = $this->photoService->filterPhotosArray($photos, $this->auth->role);
        }
        return view('pages.photos.search', compact('photos', 'isAdmin'));
    }
}