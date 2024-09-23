<x-layout>


    @if (auth()->user() && auth()->user()->isAdmin())
        <div class="block p-5 m-auto bg-white ">
            <a href="/product/create"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none ">New
                Product</a>

        </div>
    @endif

    <div class="grid grid-cols-3 gap-4">

        @forelse ($products as $product)
            <div class="block max-w-sm m-5     bg-white border border-gray-200 rounded-lg shadow ">
                <a href="{{ route('product.show', $product) }}">
                <div class="h-[250px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"class="w-full h-full rounded object-cover"
                            alt="{{ $product->title }}">
                    @endif
                </div>
                </a>
                <div class="p-5">

                    <a href="{{ route('product.show', $product) }}">
                        <h5 class="mb-2 text-2xl">Product name:
                            {{ $product->title }}</h5>
                    </a>

                    <p class="">Price: ${{ $product->price }}</p>


                    <h4>Category:</h4>
                    <p>{{ $product->category ? $product->category->name : 'No Category' }}</p>

                    <form action="{{ route('cart.add') }}" method="POST" class="mt-10">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" class="font-large"
                            style="width: 60px;">
                        <button type="submit"
                            class="inline-flex items-center  px-5 py-2.5 text-sm font-medium text-center text-white bg-green-700 rounded-lg   hover:bg-green-800">
                            Add to Cart</button>
                    </form>

                </div>
            </div>
            @empty

            <p>No product available. Please login as admin and create some product. You will get admin user and password from database > seeders > SatabaseSeeder.php file.</p>
        @endforelse

    </div>



    {{ $products->links() }}

</x-layout>
