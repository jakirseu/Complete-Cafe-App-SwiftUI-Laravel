<x-layout>
    <div class="text-left mr-auto w-full">

        <h2 class="text-2xl font-bold">Your Orders</h2>

        @forelse ($orders as $order)
            <div class="block mt-6 p-6 bg-white border border-gray-200 rounded-lg shadow">
                <h2 class="text-2xl">
                    Order #{{ $order->id }} - Placed on {{ $order->created_at->format('d M Y, H:i') }}
                </h2>

                <ul class="">
                    @foreach ($order->items as $item)
                        <li class=" mt-6 p-6 bg-white border border-gray-200">
                            {{ $item->product->title }}
                            <span>Quantity: {{ $item->quantity }}</span>
                            <span>Price: ${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>

            </div>
        @empty
            <p>You have no orders yet.</p>
        @endforelse

    </div>
</x-layout>
