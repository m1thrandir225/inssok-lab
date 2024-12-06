<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Transaction Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
<nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('transactions.index') }}" class="text-xl font-bold">Transactions</a>
        <div>
            <a href="{{ route('transactions.create') }}" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                Create New Transaction
            </a>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mx-auto mt-4 px-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    </div>
@endif

<div class="container mx-auto mt-8 px-4">
    @yield('content')
</div>

@stack('scripts')
</body>
</html>
