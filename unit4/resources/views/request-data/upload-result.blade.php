<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Result</title>
</head>
<body>
    <h1>File(s) Uploaded Successfully!</h1>

    @if(isset($file_path))
        <h2>Profile Photo</h2>
        <p>File Name: {{ $file_name }}</p>
        <p>File Size: {{ number_format($file_size / 1024, 2) }} KB</p>
        <p>MIME Type: {{ $file_mime }}</p>
        <p>Extension: {{ $file_extension }}</p>
        <p>Stored Path: {{ $file_path }}</p>

        <h3>Preview:</h3>
        <img src="{{ $file_url }}" alt="Uploaded profile photo" style="max-width: 300px;">

        <h3>File Upload Functions Used:</h3>
        <pre>
$request->hasFile('profile_photo')           // Check if file exists
$file = $request->file('profile_photo')      // Get file object
$file->getClientOriginalName()               // Get original filename
$file->getSize()                             // Get file size
$file->getMimeType()                         // Get MIME type
$file->store('uploads/profiles', 'public')   // Store file
        </pre>
    @endif

    @if(isset($document_path))
        <h2>Additional Document</h2>
        <p>Stored Path: {{ $document_path }}</p>
        <p>Document has been successfully uploaded!</p>
    @endif

    <a href="/request-data/upload-form">Upload Another File</a> |
    <a href="/request-data">Back to Request Data Home</a>
</body>
</html>
