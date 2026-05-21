<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="POST" action="{{ route('store') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter student name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter student email" required>
        
        <button type="submit">Add Student</button>
        <a href="{{ route('index') }}"><button type="button">View All Students</button></a>
    </form>
</body>
</html>
