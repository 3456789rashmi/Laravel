<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Data Results</title>
</head>
<body>
    <h1>Request Data Retrieved</h1>

    <h2>Individual Values</h2>
    <p>Name: {{ $name ?? 'Not provided' }}</p>
    <p>Email: {{ $email ?? 'Not provided' }}</p>
    <p>Message: {{ $message ?? 'Not provided' }}</p>

    <h2>All Input Data</h2>
    <pre>{{ json_encode($all_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>

    <h2>Only Specific Fields (name, email)</h2>
    <pre>{{ json_encode($only_inputs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>

    <h2>All Except _token</h2>
    <pre>{{ json_encode($except_inputs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>

    <h2>Field Existence Checks</h2>
    <p>Has 'name' field: {{ $has_name ? 'Yes' : 'No' }}</p>
    <p>Phone field is filled: {{ $phone_filled ? 'Yes' : 'No' }}</p>

    <h2>Learning Points:</h2>
    <ul>
        <li>$request->input('key') - Get a specific input value</li>
        <li>$request->all() - Get all input data</li>
        <li>$request->only('key1', 'key2') - Get only specific fields</li>
        <li>$request->except('_token') - Get all except specific fields</li>
        <li>$request->has('key') - Check if field exists</li>
        <li>$request->filled('key') - Check if field exists and is not empty</li>
    </ul>

    <a href="/request-data/form">Submit Another Form</a> |
    <a href="/request-data">Back to Request Data Home</a>
</body>
</html>
