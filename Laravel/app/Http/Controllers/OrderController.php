<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all orders for the logged-in user, along with their items and products
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id()) // Filter orders by the authenticated user's ID
            ->orderBy('created_at', 'desc') // Optionally order by creation date
            ->get();

        // Return the view with the user's orders
        return view('order-list', compact('orders'));
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
    public function store(Request $request){
        $data = $request->validate([
            'product_id' => ['required', 'string'],
        ]);


        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id'],
        ]);

        return redirect()->route('order.index')->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "single order";
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
