<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

 // Fetch products with their associated category
 $products = Product::with('category')->orderBy('created_at', 'desc')->get();

 // Transform the data to include necessary fields
 $response = $products->map(function ($product) {
     return [
         'id' => $product->id,
         'title' => $product->title,
         'description' => $product->description,
         'price' => $product->price,
         'image' => $product->image ? url($product->image) : null,
         'category' => $product->category ? $product->category->name : null, // Single category name
     ];
 });

 return response()->json($response);

    }



    // {

        // // Fetch products with their associated categories
        // $products = Product::with('categories')->get();

        // // Transform the data to include necessary fields
        // $response = $products->map(function ($product) {
        //     return [
        //         'id' => $product->id,
        //         'name' => $product->name,
        //         'category' => $product->category ? [ // Check if category exists

        //             'name' => $product->category->name,
        //         ] : null, // Handle case where category is null
        //         // Include other product fields as needed
        //     ];
        // });

        // return response()->json($response);

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
