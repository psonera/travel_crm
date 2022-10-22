<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("products",Product::class);
        return view('products.index',[
            'products' => Product::latest()->paginate(10)
        ]);
    }

    public function getproducts(){
        $products = Product::all();
        return response()->json($products);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create.products",Product::class);
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $this->authorize("store.products",Product::class);
        $validated = $request->validated();
        Product::create($validated);

        return redirect()->route('products.index')->with('success','Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->authorize("view.products",Product::class);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize("update.products",Product::class);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductFormRequest  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request,Product $product)
    {
        $validated = $request->validated();

        if($product){
            $product->update($validated);
            $product->save();
        }
        return redirect()->route('products.index')->with('success','Product Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize("delete.products",Product::class);
        $product->delete();
        session()->flash('success', 'Product Deleted Successfully!!');
        return redirect()->back();
    }
}
