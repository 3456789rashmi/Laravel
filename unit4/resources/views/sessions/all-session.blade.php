<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Session Data</title>
</head>
<body>
    <h1>All Session Data (Total: {{ $session_count }})</h1>

    <p>Session Count: {{ $session_count }} items stored</p>

    @if($session_data)
        <table border="1">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($session_data as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            @if(is_array($value))
                                {{ json_encode($value) }}
                            @elseif(is_object($value))
                                {{ get_class($value) }}
                            @else
                                {{ substr($value, 0, 100) }}{{ strlen($value) > 100 ? '...' : '' }}
                            @endif
                        </td>
                        <td>{{ gettype($value) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No session data is currently stored. <a href="/session/form">Store some data</a></p>
    @endif

    <h2>Session Data Functions</h2>
    <ul>
        <li>session()->all() - Get all session data as array</li>
        <li>session()->count() - Count session items</li>
        <li>session()->put($key, $value) - Store data</li>
        <li>session()->forget($key) - Delete specific key</li>
        <li>session()->flush() - Delete all data</li>
    </ul>

    <a href="/session/form">Store Data</a> | 
    <a href="/session/access">Access Data</a> | 
    <a href="/session">Back to Session Home</a>
</body>
</html>
</html>
