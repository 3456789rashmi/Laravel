<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session ID Regenerated</title>
</head>
<body>
    <h1>{{ $message }}</h1>

    <h2>Session Security</h2>
    <p>session()->regenerate() creates a new session ID while keeping all session data.</p>
    <p>This is crucial after user login to prevent session fixation attacks.</p>
    <p>The old session ID is invalidated and a new one is generated.</p>

    <a href="/session/form">Store Data</a>
    <a href="/session">Back to Session Home</a>
</body>
</html>
