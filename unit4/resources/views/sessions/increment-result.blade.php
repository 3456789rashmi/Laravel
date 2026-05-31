<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Increment</title>
</head>
<body>
    <h1>Session Value Incremented</h1>
    
    <p>Key: {{ $key }}</p>
    <p style="font-size: 36px; font-weight: bold;">{{ $new_value }}</p>
    <p>This value increments by 1 each time you visit</p>

    <a href="/session/form">Store Data</a>
    <a href="/session">Back to Session Home</a>
</body>
</html>
