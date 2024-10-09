<x-layout>

    <div class="space-y-5">


    @if (auth()->user() && auth()->user()->isAdmin())

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="block  max-w-sm p-5 bg-white border border-gray-200 rounded-lg shadow ">



            <h2 class="text-2xl font-bold">Add New Category</h2>
            <form action="{{ route('category.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">

                    Add Category</button>
            </form>

        </div>
    @endif

    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Categories</h2>

    @forelse($categories as $category)
        <div class="flex  max-w-sm flex-row  items-start justify-center">
            <div class="basis-1/2"> <h2 class="text-xl font-bold">{{ $category->name }}</h2></div>
            <div class="basis-1/4">
                <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  "
                href="{{ route('category.edit', $category->id) }}"
                    class="btn btn-primary">Edit</a></div>
            <div class="basis-1/4">

                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 ">Delete</button>
                </form>

            </div>

        </div>



    @empty

        <p>No categories available.</p>
    @endforelse





    </div>

</x-layout>
