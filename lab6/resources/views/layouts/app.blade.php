<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Blog Page') }}</title>

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
<header class="bg-indigo-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <nav class="hidden md:block">
                <ul class="flex space-x-4">
                    <li>
                        Blog Posts
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="hover:bg-indigo-500 px-3 py-2 rounded-md transition duration-300">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="hover:bg-indigo-500 px-3 py-2 rounded-md transition duration-300">
                            Posts
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="hidden md:block">
            </div>

            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('categories.index') }}" class="text-white hover:bg-indigo-500 block px-3 py-2 rounded-md">
                Categories
            </a>
            <a href="{{ route('posts.index') }}" class="text-white hover:bg-indigo-500 block px-3 py-2 rounded-md">
                Posts
            </a>
        </div>
    </div>
</header>

<main class="flex-grow container mx-auto px-4 py-6 sm:px-6 lg:px-8">
    @yield('content')
</main>

<footer class="bg-gray-200 py-4 mt-6">
    <div class="container mx-auto text-center text-gray-600">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
</footer>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    }
</script>
</body>
</html>
