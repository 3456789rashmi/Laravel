<!-- File Upload Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 600px; }
        h1 { color: #333; margin-bottom: 30px; text-align: center; }
        .form-group { margin-bottom: 25px; }
        label { display: block; margin-bottom: 8px; color: #555; font-weight: 600; }
        .file-input-wrapper { position: relative; border: 2px dashed #667eea; border-radius: 6px; padding: 30px; text-align: center; cursor: pointer; transition: 0.3s; }
        .file-input-wrapper:hover { background: #f0f4ff; }
        .file-input-wrapper input[type="file"] { display: none; }
        .file-input-text { color: #667eea; font-weight: 500; }
        button { width: 100%; padding: 14px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3); }
        .info-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-bottom: 20px; border-radius: 3px; }
        .info-box strong { color: #856404; }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #667eea; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📤 File Upload Example</h1>

        <div class="info-box">
            <strong>ℹ️ Accepted Files:</strong> JPEG, PNG, JPG, GIF (Max 2MB for images), PDF, DOC, DOCX (Max 5MB for documents)
        </div>

        <form method="POST" action="/request-data/upload" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="profile_photo">Profile Photo (Required):</label>
                <div class="file-input-wrapper" onclick="document.getElementById('profile_photo').click()">
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" required>
                    <p class="file-input-text">Click to select profile photo (Image files only)</p>
                </div>
            </div>

            <div class="form-group">
                <label for="document">Document (Optional):</label>
                <div class="file-input-wrapper" onclick="document.getElementById('document').click()">
                    <input type="file" id="document" name="document" accept=".pdf,.doc,.docx">
                    <p class="file-input-text">Click to select document (PDF or Word files)</p>
                </div>
            </div>

            <button type="submit">Upload Files</button>
        </form>

        <div class="back-link">
            <a href="/request-data">← Back to Request Data Home</a>
        </div>
    </div>

    <script>
        // Update label when file is selected
        document.getElementById('profile_photo').addEventListener('change', function() {
            const wrapper = this.parentElement;
            const text = wrapper.querySelector('.file-input-text');
            text.textContent = this.files[0] ? 'Selected: ' + this.files[0].name : 'Click to select profile photo';
        });

        document.getElementById('document').addEventListener('change', function() {
            const wrapper = this.parentElement;
            const text = wrapper.querySelector('.file-input-text');
            text.textContent = this.files[0] ? 'Selected: ' + this.files[0].name : 'Click to select document';
        });
    </script>
</body>
</html>
