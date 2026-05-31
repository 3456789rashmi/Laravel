<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Status</title>
</head>
<body>
    <h1>@if($status === 'success') Success @else Error @endif</h1>
    <p>{{ $message }}</p>

    <a href="/email/form">Send Another Email</a>
</body>
</html>
