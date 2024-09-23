<x-layout>
    <div class="w-full bg-slate-50 px-5 py-5">
        <form class="space-y-5" action="{{ route('product.update',  $product) }}" method="POST"  enctype="multipart/form-data" >
            @method('PUT')
            @csrf

            <h3>Add new product</h3>

            <input type="text" id="title" name="title" value="{{ old('title', $product->title) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Product Title">
                @error('title')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{ $message }}</div>
                @enderror

                <input   type="text" inputmode="numeric" id="price" name="price" value="{{ old('price', $product->price) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Product Price">
                @error('price')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                </div>

                @error('description')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{ $message }}</div>
                @enderror


                <div class="form-group">
                    <label>Current Image:</label>
                    @if($product->image)
                        <div class="mb-3">
                            <img src="{{ asset('' . $product->image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @else
                        <p>No image available</p>
                    @endif
                </div>



                <div class="form-group">
                    <label for="image">Add New Image:</label>
                    <input type="file" name="image" class="form-control" accept="image/*" value="{{ old('image')}}">
                </div>


                @error('image')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">{{ $message }}</div>
                @enderror

                    <!-- Category Selection -->
        <div>
            <div class="max-w-sm ">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category:</label>
                <select name="category_id" id="category_id" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @error('category')
                <div>{{ $message }}</div>
            @enderror
        </div>


            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                Save product
            </button>
        </form>
    </div>
</x-layout>
