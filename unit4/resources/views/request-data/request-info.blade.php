<!-- Request Info View -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Information</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        h1 { color: #333; border-bottom: 2px solid #17a2b8; padding-bottom: 10px; }
        .info-section { background: #f9f9f9; padding: 15px; margin: 15px 0; border-left: 4px solid #17a2b8; border-radius: 3px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f0f0f0; font-weight: bold; width: 30%; }
        tr:hover { background: #f9f9f9; }
        code { background: #e9ecef; padding: 2px 6px; border-radius: 3px; }
        a { color: #17a2b8; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Request Information</h1>

        <div class="info-section">
            <h2>Basic Request Information</h2>
            <table>
                <tr>
                    <th>Property</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>HTTP Method</td>
                    <td>{{ $method }}</td>
                </tr>
                <tr>
                    <td>Current Path</td>
                    <td>{{ $path }}</td>
                </tr>
                <tr>
                    <td>Full URL</td>
                    <td>{{ $url }}</td>
                </tr>
                <tr>
                    <td>User Agent</td>
                    <td>{{ $user_agent }}</td>
                </tr>
                <tr>
                    <td>Client IP Address</td>
                    <td>{{ $ip }}</td>
                </tr>
                <tr>
                    <td>Is AJAX Request</td>
                    <td>{{ $is_ajax ? 'Yes' : 'No' }}</td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <h2>Request Headers</h2>
            <table>
                <tr>
                    <th>Header Name</th>
                    <th>Value</th>
                </tr>
                @forelse($headers as $name => $value)
                    <tr>
                        <td><code>{{ $name }}</code></td>
                        <td>{{ is_array($value) ? implode(', ', $value) : $value }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No headers found</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <div class="info-section">
            <h3>📚 Request Information Functions</h3>
            <ul style="line-height: 2;">
                <li><code>$request->method()</code> - HTTP method (GET, POST, etc.)</li>
                <li><code>$request->path()</code> - Request path only</li>
                <li><code>$request->url()</code> - Full URL</li>
                <li><code>$request->fullUrl()</code> - Full URL with query string</li>
                <li><code>$request->userAgent()</code> - User agent string</li>
                <li><code>$request->ip()</code> - Client IP address</li>
                <li><code>$request->headers->all()</code> - All request headers</li>
                <li><code>$request->ajax()</code> - Is AJAX request</li>
                <li><code>$request->getHost()</code> - Request host</li>
                <li><code>$request->getScheme()</code> - HTTP or HTTPS</li>
            </ul>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            <a href="/request-data">← Back to Request Data Home</a>
        </div>
    </div>
</body>
</html>
