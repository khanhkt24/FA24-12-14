<?php

namespace App\Http\Controllers;

use App\Models\Bienthe;
use App\Models\Product;
use App\Http\Requests\StoreBientheRequest;
use App\Http\Requests\UpdateBientheRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class BientheController extends Controller
{
    /**
     * Display a listing of the resource.
     */    
    const PATH_VIEW = 'admin/warehouse.';
    public function index()
    {
        $data = Product::query()->paginate(7);
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data = Product::query()->where('id',$id)->first();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBientheRequest $request)
    {
        {
            {
                if($request->hasFile('img')){
                    $url = Storage::put('bienthe',$request->file('img'));
                }else{
                    $url = '';
                }
                Bienthe::insert([
                    'size'=>$request->size,
                    'color'=>$request->color,
                    'quantity'=>$request->quantity,
                    'product_id'=>$request->product_id,
                    'img'=>$url,
                ]);
                return redirect()->route('warehouse.index');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bienthe $bienthe)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::query()->where('id',$id)->first();
        $data = Bienthe::query()->where('product_id',$id)->get();
        return view(self::PATH_VIEW.__FUNCTION__,compact('data','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBientheRequest $request, Bienthe $bienthe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bienthe = Bienthe::find($id)->delete();
        return back();
    }
}
