<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Email</title>
</head>
<body>
    <h1>Send Email</h1>

    <p>Email Configuration: Make sure your .env file has mail configuration set up properly (MAIL_MAILER, MAIL_FROM_ADDRESS, etc.)</p>

    <form method="POST" action="/email/send-simple">
        @csrf
        <label>Recipient Email:</label>
        <input type="email" name="recipient_email" required placeholder="recipient@example.com">

        <label>Subject:</label>
        <input type="text" name="subject" required placeholder="Email subject">

        <label>Message:</label>
        <textarea name="message" required placeholder="Enter your message"></textarea>

        <button type="submit">Send Email</button>
    </form>

    <a href="/">Back to Home</a>
</body>
</html>
