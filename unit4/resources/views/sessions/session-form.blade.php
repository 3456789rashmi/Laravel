<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store Session Data</title>
</head>
<body>
    <h1>Store Session Data</h1>

    <form method="POST" action="/session/store">
        @csrf
        <label>Session Key:</label>
        <input type="text" name="key" placeholder="e.g., user_name" required>

        <label>Session Value:</label>
        <textarea name="value" placeholder="e.g., John Doe" required></textarea>

        <button type="submit">Store in Session</button>
    </form>

    <a href="/session">Back to Session Management</a>
</body>
</html>
