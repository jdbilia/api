<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* $product = Product::findOrFail($id);

        $product->update($request->all());

        return $product; */
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->slug = is_null($request->slug) ? $product->slug : $request->slug;
            $product->description = is_null($request->description) ? $product->description : $request->description;
            $product->price = is_null($request->price) ? $product->price : $request->price;
            $product->save();

            /* return response()->json([
                "message" => "records updated successfully"
            ], 200); */
            return $product;
            } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* return Product::destroy($id); */
        return Product::findOrFail($id)->delete();
    }

    public function search($name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }

    public function destruir($id)
    {
        /* return Product::destroy($id); */
        return Product::findOrFail($id)->delete();
    }
}
