<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/submit">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br><br>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <input type="submit" value="Submit">
    </form>
</body>
</html>