<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Language</title>
</head>
<body>
    <h1>Select Language</h1>

    <p>Change Application Language: Select a language to change all text in the application. Your preference will be saved in the session.</p>

    <form method="POST" action="/localization/set-locale">
        @csrf
        <label>Choose Language:</label>
        <select name="locale" required>
            <option value="">-- Select a Language --</option>
            <option value="en">English</option>
            <option value="es">Español (Spanish)</option>
            <option value="fr">Français (French)</option>
            <option value="de">Deutsch (German)</option>
        </select>

        <button type="submit">Change Language</button>
    </form>

    <a href="/localization">Back to Localization</a>
</body>
</html>
        </div>
    </div>
</body>
</html>
