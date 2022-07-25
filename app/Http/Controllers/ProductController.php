<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validation\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index',[
            'products' => Product::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku'=> 'required|max:10|alpha_num', 
            'name'=> 'required', 
            'description'=> 'required', 
            'quantity'=> 'required', 
            'price'=> 'required', 
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success','Product has been created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        if($product)
        {
        $product->update([
            'sku' => $request->sku ? $request->sku : $product->sku,
            'name' => $request->name ? $request->name : $product->name,
            'description' => $request->description ? $request->description : $product->description,
            'price' => $request->price ? $request->price : $product->price,
            'quantity' => $request->quantity ? $request->quantity : $product->quantity,
        ]);
        
        $product ->save();
        }

        return redirect()->route ('products.index')->with('success','Product Has Been updated successfully');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    
        return redirect()->route('products.index')->with('success','Product has been deleted successfully');
    }
}
