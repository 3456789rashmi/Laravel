<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Localization</title>
</head>
<body>
    <h1>Laravel Localization (Multi-Language Support)</h1>
    
    <nav>
        <a href="/">Home</a>
        <a href="/request-data">Request Data</a>
        <a href="/session">Session Management</a>
        <a href="/email/form">Send Emails</a>
    </nav>

    <h2>Localization Demo</h2>
    <p>Learn how to use translations and support multiple languages</p>
    <a href="/localization/demo">View Localization Examples</a>

    <h2>Change Language</h2>
    <p>Select a language to change the application locale</p>
    <a href="/localization/form">Change Language</a>

    <h2>Pluralization Examples</h2>
    <p>Learn how to handle plural forms in different languages</p>
    <a href="/localization/pluralization">View Pluralization</a>

    <h2>Localization Methods Summary</h2>
    <ul>
        <li>__('messages.key') - Translate a message</li>
        <li>trans('messages.key') - Same as __</li>
        <li>__('messages.key', ['name' => 'John']) - Translation with parameters</li>
        <li>trans_choice('messages.key', $count) - Pluralization</li>
        <li>app()->getLocale() - Get current locale</li>
        <li>app()->setLocale('es') - Set current locale</li>
    </ul>

</body>
</html>

