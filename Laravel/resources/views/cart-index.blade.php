<x-layout>
    <div class="text-left mr-auto w-full">

        <h2 class="text-2xl font-bold">Your Cart</h2>

        @foreach ($cart as $id => $item)
            <div class="block mt-6 p-6 bg-white border border-gray-200 rounded-lg shadow">

                <h5 class="mb-2 text-2xl font-bold">{{ $item['title'] }}</h5>
                <p>Count: {{ $item['quantity'] }}</p>
                <p>Total: {{ $total }}</p>
            </div>
        @endforeach

        @if (count($cart) > 0)
            <form action="{{ route('cart.placeOrder') }}" method="POST">
                @csrf
                <button type="submit"
                    class="inline-flex  mt-6  items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-700 rounded-lg  hover:bg-green-800">
                    Place Order</button>
            </form>
        @else
        <p>Your cart is empty. Add some products.</p>
        @endif

    </div>
</x-layout>
