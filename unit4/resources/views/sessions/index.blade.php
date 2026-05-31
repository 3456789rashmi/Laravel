<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Management</title>
</head>
<body>
    <h1>Laravel Session Management</h1>
        
    <nav>
        <a href="/">Home</a>
        <a href="/request-data">Request Data</a>
        <a href="/email/form">Send Emails</a>
        <a href="/localization/demo">Localization</a>
    </nav>

    <h2>Store Session Data</h2>
    <p>Learn how to store data in sessions</p>
    <a href="/session/form">Store Data in Session</a>

    <h2>Access Session Data</h2>
    <p>Learn how to retrieve data from sessions</p>
    <a href="/session/access">View Session Data</a>

    <h2>Delete Session Data</h2>
    <p>Learn how to remove data from sessions</p>
    <a href="/session/show-all">Manage Session</a>

    <h2>Session Methods Summary</h2>
    <ul>
        <li>session(['key' => 'value']) - Store data in session</li>
        <li>session('key') - Retrieve session data</li>
        <li>session()->all() - Get all session data</li>
        <li>session()->has('key') - Check if key exists</li>
        <li>session()->forget('key') - Delete a session key</li>
        <li>session()->flush() - Delete all session data</li>
        <li>session()->flash('key', 'value') - Store data for next request only</li>
        <li>session()->regenerate() - Regenerate session ID (security)</li>
    </ul>

</body>
</html>
