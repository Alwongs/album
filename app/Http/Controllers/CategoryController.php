<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PhotoService;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
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
        $userId = $this->auth->followed_id != 0 ? $this->auth->followed_id : $this->auth->id;
        $isAdmin = $this->isAdmin;
        $categories = Category::where('user_id', $userId)->orderBy('title', 'ASC')->get();

        return view('pages.categories.categories', compact('categories', 'isAdmin'));
    }

    public function create()
    {
        return view('pages.categories.add');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $request->all();
        $category['user_id'] = Auth::user() ? Auth::user()->id : 0;

        try {
            Category::create($category);
        } catch(\Illuminate\Database\QueryException $ex){
            return back()->withErrors(['error' => $ex->getMessage()]);
        }   
        
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        if (
            $category->user_id != $this->auth->id 
            && !$this->photoService->checkIfFollower($category->user_id, $this->auth->followed_id)
        ) {
            return view('errors.404');
        }
        
        $isAdmin = $this->isAdmin;
        if (!$isAdmin) {
            $category->photos = $this->photoService->filterPhotosArray($category->photos, $this->auth->role);
        }

        $categoryIds = [];
        foreach ($category->photos as $photo) {
            $categoryIds[] = $photo->id;
        }

        return view('pages.categories.category', compact('category', 'categoryIds', 'isAdmin'));

    }

    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('category'));   
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {   
        // TODO: to improve request validation. permit not unique title when updating, 
        $data = $request->validated();  
        $category->update($data);

        return redirect()->route('categories.index');            
    }

    public function destroy(Category $category)
    {
        foreach($category->photos as $photo) {
            $this->photoService->removeFromStorage($photo);
        }
        $category->delete();
        return redirect()->back();
    }
}
