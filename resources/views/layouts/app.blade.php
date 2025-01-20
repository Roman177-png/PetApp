<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pet Store')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">Pet Store Management</h1>
    </div>
</header>
<main class="container mx-auto px-4 py-6">
    @yield('content')
</main>
<footer class="bg-gray-800 text-white py-4 mt-6">
    <div class="container mx-auto px-4 text-center">
        <p>&copy; 2025 Pet Store. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
