<!DOCTYPE html>
<html>
<head>
    <title>Dodawanie zwierzaka</title>
</head>
<body>
    <form action="/api/pets" method="POST">
        @csrf
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Wyślij</button>
    </form>
</body>
</html>
