<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Data Form</title>
</head>
<body>
    <h1>Submit Form Data</h1>
    
    <form method="POST" action="/request-data/process">
        @csrf
        
        <label>Name:</label>
        <input type="text" name="name" required>
        
        <label>Email:</label>
        <input type="text" name="email" required>
        
        <label>Message:</label>
        <textarea name="message"></textarea>
        
        <label>Subject:</label>
        <select name="subject">
            <option value="">Select a subject</option>
            <option value="general">General Inquiry</option>
            <option value="support">Support</option>
            <option value="feedback">Feedback</option>
        </select>
        
        <button type="submit">Submit Form</button>
    </form>
    
    <a href="/request-data">Back to Request Data Home</a>
</body>
</html>
