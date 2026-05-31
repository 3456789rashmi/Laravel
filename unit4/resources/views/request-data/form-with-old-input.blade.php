<!-- Old Input Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Old Input</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 500px; }
        h1 { color: #333; margin-bottom: 10px; text-align: center; }
        .subtitle { text-align: center; color: #666; margin-bottom: 30px; font-size: 14px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #555; font-weight: 500; }
        input[type="text"], input[type="email"], textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; font-family: inherit; }
        input:focus, textarea:focus { outline: none; border-color: #667eea; box-shadow: 0 0 5px rgba(102, 126, 234, 0.1); }
        textarea { resize: vertical; min-height: 100px; }
        button { width: 100%; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3); }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #667eea; text-decoration: none; font-size: 14px; }
        .info-box { background: #e3f2fd; border-left: 4px solid #2196f3; padding: 15px; margin-bottom: 20px; border-radius: 3px; }
        .info-box h3 { color: #1976d2; margin-bottom: 10px; }
        .info-box p { color: #555; font-size: 13px; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📝 Old Input (Flash Data)</h1>
        <p class="subtitle">Your previously submitted data is populated below</p>

        <div class="info-box">
            <h3>💡 What is Old Input?</h3>
            <p>After form validation fails or on redirect, Laravel automatically flashes the old input data so you can repopulate form fields with the user's previous submission.</p>
        </div>

        <form method="POST" action="/request-data/redirect-with-old-input">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="phone">Phone (Optional):</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone">
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Enter your message">{{ old('message') }}</textarea>
            </div>

            <button type="submit">Submit & See Old Input</button>
        </form>

        <div class="back-link">
            <a href="/request-data">← Back to Request Data Home</a>
        </div>
    </div>
</body>
</html>
