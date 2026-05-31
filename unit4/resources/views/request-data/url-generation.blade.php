<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Generation</title>
</head>
<body>
    <h1>URL Generation in Laravel</h1>

    <h2>1. Basic URL Generation</h2>
    <p>Generate URLs for your application:</p>
    <pre>url('/path/to/page')  // Output: http://example.com/path/to/page</pre>
    <p>Example: <a href="{{ url('/request-data') }}">{{ url('/request-data') }}</a></p>

    <h2>2. Route URL Generation</h2>
    <p>Generate URLs to named routes:</p>
    <pre>route('home')  // Output: http://example.com/
route('users.show', ['id' => 1])  // Output: http://example.com/users/1</pre>
    <p>Example: <a href="{{ route('home') }}">Home Route</a></p>

    <h2>3. Secure URLs (HTTPS)</h2>
    <p>Generate secure URLs:</p>
    <pre>secure_url('/path')  // Forces HTTPS
route('users.show', ['id' => 1], true)  // Secure route URL</pre>

    <h2>4. Query String URLs</h2>
    <p>Generate URLs with query parameters:</p>
    <pre>url('/search?q=laravel&sort=date')
route('posts.index', ['page' => 2, 'sort' => 'date'])</pre>

    <h2>5. Current URL and Path</h2>
    <p>Get information about the current request:</p>
    <pre>request()->url()     // Full URL with query string
request()->path()    // Path only (e.g., 'users/1')
request()->fullUrl() // URL with query string</pre>
    <p>Current URL: {{ request()->fullUrl() }}</p>
    <p>Current Path: {{ request()->path() }}</p>

    <h2>6. Previous URL</h2>
    <p>Redirect user back to previous page:</p>
    <pre>url()->previous()  // Get previous URL
redirect()->back()  // Redirect to previous page</pre>

    <h2>7. Asset URLs</h2>
    <p>Generate URLs for CSS, JS, and images:</p>
    <pre>asset('css/app.css')        // /css/app.css
asset('js/app.js')          // /js/app.js
asset('images/logo.png')    // /images/logo.png</pre>

    <h2>8. URL Helpers Summary</h2>
    <ul>
        <li>url() - Generate full URL</li>
        <li>route() - Generate route URL</li>
        <li>secure_url() - Generate secure (HTTPS) URL</li>
        <li>asset() - Generate asset URL</li>
        <li>request()->url() - Get current URL</li>
        <li>request()->path() - Get current path</li>
        <li>url()->previous() - Get previous URL</li>
    </ul>

    <a href="/request-data">Back to Request Data Home</a>
</body>
</html>
