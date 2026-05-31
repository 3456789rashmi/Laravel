<!-- Cookie Result View -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Results</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #333; border-bottom: 2px solid #f5576c; padding-bottom: 10px; }
        .result-section { background: #f9f9f9; padding: 15px; margin: 15px 0; border-left: 4px solid #f5576c; border-radius: 3px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f0f0f0; font-weight: bold; }
        tr:hover { background: #f9f9f9; }
        .code-block { background: #f0f0f0; padding: 10px; margin: 10px 0; border-radius: 3px; font-family: monospace; font-size: 12px; overflow-x: auto; }
        a { color: #f5576c; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .yes { color: green; font-weight: bold; }
        .no { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍪 Cookie Information</h1>

        <div class="result-section">
            <h2>User Preference Cookie</h2>
            <p><strong>Value:</strong> {{ $user_preference }}</p>
        </div>

        <div class="result-section">
            <h2>All Cookies in Your Browser</h2>
            @if($all_cookies)
                <table>
                    <thead>
                        <tr>
                            <th>Cookie Name</th>
                            <th>Cookie Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_cookies as $name => $value)
                            <tr>
                                <td>{{ $name }}</td>
                                <td>{{ substr($value, 0, 50) }}{{ strlen($value) > 50 ? '...' : '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No cookies found.</p>
            @endif
        </div>

        <div class="result-section">
            <h2>Cookies Existence Check</h2>
            <p><strong>Has 'user_preference' cookie:</strong> <span class="{{ $has_cookie ? 'yes' : 'no' }}">{{ $has_cookie ? 'Yes' : 'No' }}</span></p>
        </div>

        <div class="result-section">
            <h3>📚 Cookie Functions Summary</h3>
            <div class="code-block">
cookie('name')                          // Create a cookie
response()->cookie('key', 'value', 60)  // 60 minutes expiration
$request->cookie('key')                 // Get cookie value
$request->hasCookie('key')              // Check if cookie exists
$request->cookies->all()                // Get all cookies
response()->cookie('key', null, -1)     // Delete cookie
            </div>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            <a href="/request-data/cookie-form">← Manage More Cookies</a> | 
            <a href="/request-data">← Back to Request Data Home</a>
        </div>
    </div>
</body>
</html>
