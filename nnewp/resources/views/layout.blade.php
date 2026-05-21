<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Application')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    
    @yield('styles')
</head>
<body>
    <!-- Navigation/Header -->
    <header class="navbar">
        @yield('header')
    </header>

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        @yield('footer')
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('resources/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
