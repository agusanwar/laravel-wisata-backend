<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        // with for call category
        $products = Product::with('category')->when($request->keyword, function ($query) use ($request) {
            $query->where('status', 'like', "%{$request->status}%");
        })->orderBy('is_favorite', 'desc')->get();
        
        return response()->json(['status' => 'success', 'data' => $products], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            // 'image' => 'required',
            'criteria' => 'required',
            // 'is_favorite' => 'required',
            // 'status' => 'required',
            // 'stock' => 'required',
        ]);

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->desc = '';
        $product->price = $request->price;
        $product->criteria = $request->criteria;
        $product->is_favorite = false;
        $product->status = 'published';
        $product->stock = 0;
        $product->save();

         // save image
         if($request->image){
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.png');
            $product->image = $product->id . '.png';
            $product->save();
        }
        
        // product with catoery
        $product = Product::with('category')->find($product->id);

        return response()->json(['status' => 'succes', 'data' => $product], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        return response()->json(['status' => 'succes', 'data' => $product], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        
        // // var_dump($product);
        // $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        // $product->desc = $request->desc;
        // $product->criteria = $request->criteria;
        // $product->is_favorite = $request->is_favorite;
        // $product->status = $request->status;
        // $product->stock = $request->stock;
        $product->save();

         // save image
        //  if($request->image){
        //     $image = $request->file('image');
        //     $image->storeAs('public/products', $product->id . '.png');
        //     $product->image = $product->id . '.png';
        //     $product->save();
        // }

           // product with catoery
           $product = Product::with('category')->find($product->id);
        return response()->json(['status' => 'succes', 'data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['status' => 'succes', 'message' => 'Product deleted succefully'], 200);
    }
}
