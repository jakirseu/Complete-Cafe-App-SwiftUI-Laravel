<x-layout>
    <div class="text-left mr-auto w-full">

        <h2 class="text-2xl font-bold">Add Category</h2>
        <form action="{{ route('category.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">

            Add Category</button>
        </form>

    </div>
</x-layout>
