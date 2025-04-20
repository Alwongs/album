<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\PhotoService;

class CategoryController extends Controller
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->orderBy('title', 'ASC')->get();
        return view('pages.categories.categories', [ 'categories' => $categories]);
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
        if ($category->user_id != Auth::id()) {
            return 'Access denied!';
        }

        return view('pages.categories.category', compact('category'));
    }

    public function edit(Category $category)
    {
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
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
