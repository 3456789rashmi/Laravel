<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pluralization Example</title>
</head>
<body>
    <h1>Pluralization Demo</h1>
    <p>Test plural forms in different languages</p>

    <p>Pluralization: Different languages have different pluralization rules. Laravel handles this automatically with trans_choice().</p>

    <form method="GET" action="/localization/pluralization">
        <label>Enter Number of Items:</label>
        <input type="number" name="count" min="0" max="1000" value="1" required>

        <button type="submit">Show Plural Form</button>
    </form>

    <a href="/localization">Back to Localization</a>
</body>
</html>
