<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="POST" action="{{ route('update', $data->_id) }}">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $data->name }}" placeholder="Enter student name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $data->email }}" placeholder="Enter student email" required>
        
        <button type="submit">Update Student</button>
        <a href="{{ route('index') }}"><button type="button">Back to Students</button></a>
    </form>
</body>
</html>