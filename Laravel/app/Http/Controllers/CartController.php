<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Order;

class CartController extends Controller
{
    // Display the cart
    public function index()
    {
        // Retrieve cart items from session
        $cart = session()->get('cart', []);

        // Calculate the total price
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + $item['price'] * $item['quantity'];
        }, 0);

        return view('cart-index', compact('cart', 'total'));
    }

    // Add a product to the cart
    public function add(Request $request)
    {
        // Validate product ID and quantity
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            // Increment the quantity if it already exists
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // Add the product to the cart
            $cart[$product->id] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $request->quantity,
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    // Update the quantity of a product in the cart
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
    }

    // Remove a product from the cart
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
        }

        return redirect()->route('cart.index')->with('error', 'Product not found in cart!');
    }

    // Place the order
    public function placeOrder()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Create the order for the logged-in user
        $order = Order::create([
            'user_id' => Auth::id(),
        ]);

        // Iterate through the cart and create order items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'], // Store the quantity of each product
            ]);
        }

        // Clear the cart after placing the order
        session()->forget('cart');

        return redirect()->route('order.index')->with('success', 'Order placed successfully!');
    }
}

