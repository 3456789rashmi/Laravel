<!-- Cookie Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Management</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        h1 { color: #333; margin-bottom: 10px; text-align: center; }
        .subtitle { text-align: center; color: #666; margin-bottom: 30px; font-size: 14px; }
        .section { margin-bottom: 35px; }
        .section h2 { color: #555; font-size: 16px; margin-bottom: 15px; border-bottom: 2px solid #f5576c; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 6px; color: #555; font-weight: 500; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        input:focus { outline: none; border-color: #f5576c; box-shadow: 0 0 5px rgba(245, 87, 108, 0.1); }
        button { width: 100%; padding: 12px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; margin-bottom: 10px; }
        button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3); }
        .secondary-btn { background: #6c757d; }
        .secondary-btn:hover { background: #5a6268; }
        .info-box { background: #f0f8ff; border-left: 4px solid #f5576c; padding: 12px; margin-bottom: 20px; border-radius: 3px; font-size: 13px; }
        a { color: #f5576c; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍪 Cookie Management</h1>
        <p class="subtitle">Set, retrieve, and delete cookies</p>

        <div class="info-box">
            <strong>💡 Tip:</strong> Cookies are stored on the client's browser and sent with every request. Use them for small amounts of data like user preferences.
        </div>

        <div class="section">
            <h2>Set a Cookie</h2>
            <form method="POST" action="/request-data/cookie/set">
                @csrf
                <div class="form-group">
                    <label for="cookie_name">Cookie Name:</label>
                    <input type="text" id="cookie_name" name="cookie_name" placeholder="e.g., user_preference" required>
                </div>

                <div class="form-group">
                    <label for="cookie_value">Cookie Value:</label>
                    <input type="text" id="cookie_value" name="cookie_value" placeholder="e.g., dark_theme" required>
                </div>

                <button type="submit">Set Cookie</button>
            </form>
        </div>

        <div class="section">
            <h2>Retrieve Cookies</h2>
            <form method="GET" action="/request-data/cookie/retrieve">
                <button type="submit">View All Cookies</button>
            </form>
        </div>

        <div class="section">
            <h2>Delete Cookie</h2>
            <form method="POST" action="/request-data/cookie/delete">
                @csrf
                <button type="submit" class="secondary-btn">Delete Cookie</button>
            </form>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="/request-data">← Back to Request Data Home</a>
        </div>
    </div>
</body>
</html>
