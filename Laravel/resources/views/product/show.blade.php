<x-layout>

    <div class="bg-gray-100 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">

                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"class="w-full h-full rounded object-cover"
                                alt="{{ $product->title }}">
                        @endif
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <div class="flex -mx-2 mb-4">
                            <div class="w-1/2 px-2">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="1" min="1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="w-1/2 px-2">
                                <button
                                    class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Add
                                    to Cart</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Product Name:
                        {{ $product->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed
                        ante justo. Integer euismod libero id mauris malesuada tincidunt.
                    </p>

                    <div class="mr-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Price:</span>
                        <span class="text-gray-600 dark:text-gray-300">${{ $product->price }}</span>
                    </div>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Availability:</span>
                        <span class="text-gray-600 dark:text-gray-300">In Stock</span>
                    </div>

                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300">Product Description:</span>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                            {{ $product->description }}
                        </p>
                        <h4>Category:</h4>
                        <p>{{ $product->category ? $product->category->name : 'No Category' }}</p>
                    </div>
                    <form action="{{ route('product.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="m-5">
                        <a  href="{{ route('product.edit', $product)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                    <button  type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>

                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


</x-layout>
