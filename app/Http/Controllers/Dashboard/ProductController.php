<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('desc', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            $categories = Category::orderBy('name', 'ASC')->get();
            return view('pages.products.create', compact('categories'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'criteria' => 'required',
            'is_favorite' => 'required',
            'status' => 'required',
            'stock' => 'required',
        ]);

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;

        $product->criteria = $request->criteria;
        $product->is_favorite = $request->is_favorite;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->save();

        // save image
        if($request->image){
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->extension());
            $product->image = 'storage/public/products/' . $product->id . '.' . $image->extension();
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        var_dump('image');
       // validasi requuest
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'status' => 'required',
            'is_favorite' => 'required|boolean',
            'criteria' => 'required'
        ]);

        // store product request
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->criteria = $request->criteria;
        $product->is_favorite = $request->is_favorite;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.' . $image->extension());
            $product->image = 'storage/public/products/' . $product->id . '.' . $image->extension();
            $product->save();
        }
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
