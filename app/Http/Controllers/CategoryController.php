<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin/category.';
    public function index()
    {
        $data = Category::query()->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::insert([
            'name'=>$request->name,
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $data = Tag::query()->where('category_id',$category->id)->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data','category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view(self::PATH_VIEW.__FUNCTION__,compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Category::where('id',$category->id)->update([
            'name'=>$request->name,
            'updated_at'=> Carbon::now()->format("Y-m-d H:i:s")
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::find($category->id);
        $category->delete();
        return back();
    }
    public function bin()
    {
        $data = Category::onlyTrashed()->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }
    public function restore($category)
    {
                $data = Category::withTrashed()->find($category);
                
                if ($data) {
                    $data->restore(); // Khôi phục sản phẩm
                    
                    return redirect()->route('category.index');
                }
                
                return redirect()->back()->with('error', 'Product not found.');
    }
}
