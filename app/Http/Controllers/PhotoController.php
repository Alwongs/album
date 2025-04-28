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
        // if ($this->auth->role != 'A') {
        //     return view('errors.404');
        // }

        $category = Category::find($request->input('category_id'));
        return view('pages.photos.add', compact('category'));
    }

    public function store(StorePhotoRequest $request)
    {
        // if ($this->auth->role != 'A') {
        //     return view('errors.404');
        // }

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
        if (
            ($photo->user_id != $this->auth->id
            && !$this->photoService->checkIfFollower($photo->user_id, $this->auth->followed_id))
            || !$this->photoService->checkPhotoAccess($photo->access, $this->auth->role)
        ) {
            return view('errors.404'); 
        }

        $isAdmin = $this->isAdmin;

        return view('pages.photos.photo', compact('photo', 'isAdmin'));
    }

    public function edit(Photo $photo)
    {
        // if ($this->auth->role != 'A') {
        //     return view('errors.404');
        // }

        return view('pages.photos.edit', compact('photo'));        
    }

    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        // if ($this->auth->role != 'A') {
        //     return view('errors.404');
        // }

        $data = $request->validated();  
        $photo->update($data);

        return redirect()->route('categories.show', $photo['category_id']);
    }

    public function destroy(Photo $photo)
    {
        // if ($this->auth->role != 'A') {
        //     return view('errors.404');
        // }

        $this->photoService->removeFromStorage($photo);
        $photo->delete();
        return redirect()->back();
    }
}
