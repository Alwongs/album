<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Http\Services\PhotoService;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Routing\Controllers\Middleware;

class PhotoController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
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


    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'admin', except: ['index', 'show']),
        ];
    }    


    public function index()
    {
    }


    public function create(Request $request)
    {
        // TODO: check if auth_id is equal category->user_id
        $category = Category::find($request->input('category_id'));

        $accesses = [
            'A' => 'Admin',
            'F' => 'Friend',
            'G' => 'Guest'
        ];

        return view('pages.photos.add', compact('category', 'accesses'));
    }


    public function store(StorePhotoRequest $request)
    {
        $data = $request->validated();
        $newImageName = $this->photoService->saveInStorage($request);
        $photo = $this->photoService->prepearData($data, $newImageName);

        try {
            Photo::create($photo);
        } catch(\Illuminate\Database\QueryException $ex){
            return back()->withErrors(['error' => $ex->getMessage()]);
        } 

        return redirect()->route('categories.show', $photo['category_id']);
    }


    public function show(Photo $photo)
    {
        $allowedAccesses = $this->photoService->getAllowedAccesses($this->auth->role);
        $nextPhoto = Photo::where('category_id', $photo->category_id)
            ->whereIn('access', $allowedAccesses)
            ->where('id', '>', $photo->id)
            ->orderBy('id')
            ->first();
        $previousPhoto = Photo::where('category_id', $photo->category_id)
            ->whereIn('access', $allowedAccesses)
            ->where('id', '<', $photo->id)
            ->orderBy('id', 'desc')
            ->first();

        $isAccessOkForRole = $this->photoService->checkPhotoAccess($photo->access, $this->auth->role);
        $isAuthFollower = $this->photoService->checkIfFollower($photo->user_id, $this->auth->followed_id);
        $isAuthOwner = $photo->user_id == $this->auth->id;
        if (
            (!$isAuthOwner && !$isAuthFollower)
            || !$isAccessOkForRole
        ) {
            return view('errors.404'); 
        }

        $isAdmin = $this->isAdmin;

        return view('pages.photos.photo', compact('isAdmin', 'photo', 'nextPhoto', 'previousPhoto'));
    }


    public function edit(Photo $photo)
    {
        $accesses = [
            'A' => 'Admin',
            'F' => 'Friend',
            'G' => 'Guest'
        ];

        $category = $photo->category;

        return view('pages.photos.edit', compact('category', 'photo', 'accesses'));        
    }


    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $data = $request->validated();  
        $photo->update($data);

        return redirect()->route('categories.show', $photo['category_id']);
    }


    public function destroy(Photo $photo)
    {
        $this->photoService->removeFromStorage($photo);
        $photo->delete();
        return redirect()->route('categories.show', $photo->category_id);
    }
}
