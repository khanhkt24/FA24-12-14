<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin/tag.';
    public function index()
    {
        $data = Tag::query()->with(['category'])->paginate(5);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $category = Category::query()->pluck('name','id')->all();
            return view(self::PATH_VIEW.__FUNCTION__,compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        {
            if($request->hasFile('img')){
                $url = Storage::put('tag',$request->file('img'));
            }else{
                $url = '';
            }
            tag::insert([
                'name'=>$request->name,
                'category_id'=>$request->category_id,
                'img'=>$url,
            ]);
            return redirect()->route('tag.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $data = Product::query()->where('tag_id',$tag->id)->paginate(5);
        $tag1 = Tag::query()->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data','tag','tag1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $category = Category::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW.__FUNCTION__,compact('category','tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        if($request->hasFile('img')){
            Storage::delete($tag->img);
            $url = Storage::put('tag',$request->file('img'));
        }else{
            $url = $tag->img;
        }
        Tag::where('id',$tag->id)->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'img'=>$url,
            'updated_at'=> Carbon::now()->format("Y-m-d H:i:s")
        ]);
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $product = Tag::find($tag->id);
        $product->delete();
        return back();
    }
    public function bin()
    {
        $data = Tag::onlyTrashed()->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }
    public function restore($tag)
    {
                $data = Tag::withTrashed()->find($tag);
                
                if ($data) {
                    $data->restore(); // Khôi phục sản phẩm
                    
                    return redirect()->route('tag.index');
                }
                
                return redirect()->back()->with('error', 'Product not found.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)||$query=="") {
            return redirect()->route('tag.index'); // Trả về trang cũ
        }
        $data = Tag::where('name', 'LIKE', "%{$query}%")
            ->orWhere('id', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('admin.tag.index', compact('data'));
    }
}
