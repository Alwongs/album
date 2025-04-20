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

class PhotoController extends Controller
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function index()
    {
    }

    public function create(Request $request)
    {
        $category = Category::find($request->input('category_id'));
        return view('pages.photos.add', compact('category'));
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
        return view('pages.photos.photo', compact('photo'));
    }

    public function edit(Photo $photo)
    {
        return view('pages.photos.edit', compact('photo'));        
    }





    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $data = $request->validated();  
        
        $photo->update($data);
    }






    public function destroy(Photo $photo)
    {
        $this->photoService->removeFromStorage($photo);
        $photo->delete();
        return redirect()->back();
    }
}
