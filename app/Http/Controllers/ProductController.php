<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Bienthe;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin/product.';
    public function index()
    {
        $category = Category::query()->get();
        $tag = Tag::query()->get();
        $data = Product::query()->with(['tag'])->with(['category'])->paginate(7);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data','category','tag',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $tag =Tag::query()->pluck('name','id')->all();
            $category = Category::query()->pluck('name','id')->all();
            return view(self::PATH_VIEW.__FUNCTION__,compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        {
            if($request->hasFile('img')){
                $url = Storage::put('product',$request->file('img'));
            }else{
                $url = '';
            }
            Product::insert([
                'name'=>$request->name,
                'cost'=>$request->cost,
                'sale'=>'',
                'tag_id'=>$request->tag_id,
                'category_id'=>$request->category_id,
                'description'=>$request->description,
                'img'=>$url,
            ]);
            return redirect()->route('product.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $tag =Tag::query()->where('id',$product->tag_id)->first();
        $category = Category::query()->where('id',$product->category_id)->first();
        $total = Bienthe::query()->where('product_id',$product->id)->sum('quantity');
        $bienthe = Bienthe::query()->where('product_id',$product->id)->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('category','tag','product','total','bienthe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tag =Tag::query()->pluck('name','id')->all();
        $category = Category::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW.__FUNCTION__,compact('category','tag','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if($request->hasFile('img')){   
            $url = Storage::put('product',$request->file('img'));
        }else{
            $url = $product->img;
        }
        Product::where('id',$product->id)->update([
            'name'=>$request->name,
            'cost'=>$request->cost,
            'tag_id'=>$request->tag_id,
            'category_id'=>$request->category_id,
            'description'=>$request->description,
            'img'=>$url,
            'updated_at'=> Carbon::now()->format("Y-m-d H:i:s")
        ]);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        $product->delete();
        return back();
    }
    public function bin()
    {
        $tag = Tag::query()->get();
        $category = Category::query()->get();
        $data = Product::onlyTrashed()->paginate(7);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data','tag','category'));
    }
    public function restore($product)
    {
                $data = Product::withTrashed()->find($product);
                
                if ($data) {
                    $data->restore(); // Khôi phục sản phẩm
                    
                    return redirect()->route('product.index');
                }
                
                return redirect()->back()->with('error', 'Product not found.');
    }
    public function forceDelete($product)
    {
                $data = Product::withTrashed()->find($product);
                
                if ($data) {
                    $data->forceDelete();
                    
                    return redirect()->route('product.index');
                }
                
                return redirect()->back()->with('error', 'Product not found.');
    }
    public function search(Request $request)
    {
        $tag = Tag::query()->get();
        $query = $request->input('query');

        if (empty($query)||$query=="") {
            return redirect()->route('product.index'); 
        }
        $data = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('id', 'LIKE', "%{$query}%")
            ->paginate(7);

        return view('admin.product.index', compact('data','tag'));
    }
    public function filter(Request $request)
    {
        $tag = Tag::query()->get();
        $minPrice = $request->input('min_price');  
        $maxPrice = $request->input('max_price');  

        $products = Product::query();

        if ($minPrice) {
            $products->where('cost', '>=', $minPrice);  
        }

        if ($maxPrice) {
            $products->where('cost', '<=', $maxPrice);  
        }
        $data = $products->get();
        return view('admin.product.index', compact('data','tag'));
    }
}
