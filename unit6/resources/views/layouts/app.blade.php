<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Unit6 - Course Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Unit6 - Course Management</h1>
            <ul class="flex space-x-4">
                <li><a href="/" class="hover:text-blue-400">Home</a></li>
                <li><a href="/dashboard" class="hover:text-blue-400">Dashboard</a></li>
                <li><a href="/courses" class="hover:text-blue-400">Courses</a></li>
                <li><a href="/users" class="hover:text-blue-400">Users</a></li>
                <li><a href="/api/stats" class="hover:text-blue-400">API Stats</a></li>
            </ul>
        </div>
    </nav>

    <main class="container mx-auto my-8">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Unit6 - Course Management System. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
