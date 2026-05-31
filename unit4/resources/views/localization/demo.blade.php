<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Localization Demo</title>
</head>
<body>
    <h1>Localization Demo</h1>

    <p>Current Locale: {{ $current_locale }}</p>
    <p>Available Locales: {{ implode(', ', $available_locales) }}</p>

    <h2>Change Language</h2>
    <a href="/localization/set/en">English</a>
    <a href="/localization/set/es">Español</a>
    <a href="/localization/set/fr">Français</a>
    <a href="/localization/set/de">Deutsch</a>

    <h2>Translation Examples</h2>
    
    <h3>Welcome Message</h3>
    <p>Key: messages.welcome</p>
    <p>Translation: {{ $translations['welcome'] ?? 'Translation not found' }}</p>

    <h3>Greeting with Parameter</h3>
    <p>Key: messages.greeting</p>
    <p>Translation: {{ $translations['greeting'] ?? 'Translation not found' }}</p>

    <h3>Items Count</h3>
    <p>Key: messages.items_count</p>
    <p>Translation: {{ $translations['items_count'] ?? 'Translation not found' }}</p>

    <h3>Hello & Goodbye</h3>
    <p>Hello: {{ $translations['hello'] ?? 'Not found' }}</p>
    <p>Goodbye: {{ $translations['goodbye'] ?? 'Not found' }}</p>

    <h2>Translation Methods</h2>
    <ul>
        <li>__('messages.key') - Primary translation helper</li>
        <li>trans('messages.key') - Alias for __()</li>
        <li>__('messages.greeting', ['name' => 'John']) - Translation with parameters</li>
        <li>trans_choice('messages.key', $count) - Pluralization</li>
    </ul>

    <a href="/localization">Back to Localization Home</a>
</body>
</html>
</body>
</html>
