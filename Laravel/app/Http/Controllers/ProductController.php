<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'], ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $products =  Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view("product.index", ['products' => $products]);
    }

    public function create()
    {
       // return view('create');
       $categories = Category::all();

       return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => 'nullable|string', // Validate description field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image file
            'category_id' => 'required|exists:categories,id',
        ]);

             // Handle the image upload if there is an image
             $imagePath = null;
             if ($request->hasFile('image')) {
                 $imagePath = $request->file('image')->store('images/products', 'public'); // Store the image in the public disk
             }


        $product =  Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $data['description'],
            'image' => $imagePath, // Save the path of the image
            'category_id' => $data['category_id'],
        ]);



        return to_route('product.show', $product);
    }

    public function show(Product $product)
    {
        return view("product.show", ['product' => $product]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);  // Fetch the product by ID
        $categories = Category::all();  // Fetch all categories

        return view('product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        // Validate the incoming request
        $data = $request->validate([
            'title' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'description' => 'nullable|string', // Validate description field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for image file
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            // Store the new image in the public disk
            $imagePath = $request->file('image')->store('images/products', 'public');
            $product->image = $imagePath; // Update the image path
        }

        // Update the product fields
        $product->update([
            'title' => $data['title'],
            'price' => $data['price'],
            'description' => $data['description'], // Update description
            'category_id' => $data['category_id'], // Update category
        ]);

        // Redirect to the product's show page after update
        return to_route('product.show', $product)->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('product.index', $product);
    }
}
