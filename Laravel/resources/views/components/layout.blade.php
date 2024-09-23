<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
</head>

<body>

    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">

                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                            alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="/"
                                class="{{ request()->routeIs('product.index') ? 'bg-gray-900 text-white' : '' }} rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>

                            <a href="/cart"
                                class="  {{ request()->routeIs('cart.index') ? 'bg-gray-900 text-white' : '' }} rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Cart</a>


                            <!-- Admin-Specific Links -->

                            @if (auth()->user() && auth()->user()->isAdmin())

                                <a href="{{ route('category.index') }}"
                                    class=" {{ request()->routeIs('category.index') ? 'bg-gray-900 text-white' : '' }} rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Category</a>
                            @endif


                            <!-- Links for both Admin and Regular Users -->
                            @if (auth()->check())

                            <a href="/order"
                            class="{{ request()->routeIs('order.index') ? 'bg-gray-900 text-white' : '' }} rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Orders</a>



                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                            @else
                                 <a href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Login</a>
                                <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                                    Register</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </nav>

    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        {{ $slot }}

    </main>

</body>

</html>
