<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Session Data</title>
</head>
<body>
    <h1>{{ $message }}</h1>

    <h2>Session Deletion Methods</h2>
    <ul>
        <li>session()->forget('key') - Delete a single key</li>
        <li>session()->forget(['key1', 'key2']) - Delete multiple keys</li>
        <li>session()->flush() - Delete all session data</li>
        <li>session()->invalidate() - Invalidate entire session</li>
    </ul>

    <a href="/session/form">Store More Data</a>
    <a href="/session/access">View Session Data</a>
    <a href="/session">Back to Session Home</a>
</body>
</html>
