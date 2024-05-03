<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' =>'required',
            'description' =>'required',
            'price' => 'required', 
            'categories' => 'array', 
            'url' => 'url'
        ]);

        $product = Product::create($validated);

        if ($request->has('url')) {
            $product->image()->create(
                [
                    'url' => 'https://picsum.photos/id/'.$product->id.'/200/300'
                ]
            );
        }
        
        $product->categories()->attach($validated['categories']);

        return redirect()->route('products.index')->with('success','product created successfully');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $categories = Categorie::all();
        return view('products.show', compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
