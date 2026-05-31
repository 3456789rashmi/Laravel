<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Session Data</title>
</head>
<body>
    <h1>Session Data Retrieved</h1>

    <h2>Accessed Session Values</h2>
    <p>User Name: {{ $user_name }}</p>
    <p>Theme Preference: {{ $theme }}</p>

    <h2>All Session Data</h2>
    <pre>{{ json_encode(session()->all(), JSON_PRETTY_PRINT) }}</pre>

    <h2>Session Access Methods</h2>
    <ul>
        <li>session('key') - Get value from session</li>
        <li>session('key', 'default') - Get with default value</li>
        <li>session()->all() - Get all session data</li>
        <li>session()->has('key') - Check if key exists</li>
        <li>session()->pull('key') - Get and delete value</li>
    </ul>

    <a href="/session/form">Store Data</a> |
    <a href="/session/show-all">Manage Session</a> |
    <a href="/session">Back to Session Home</a>
</body>
</html>

