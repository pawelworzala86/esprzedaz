<!DOCTYPE html>
<html>
<head>
    <title>Formularz</title>
</head>
<body>
    <form action="/formularz" method="POST">
        @csrf
        <label for="nazwa_pola">Nazwa Pola:</label>
        <input type="text" id="nazwa_pola" name="nazwa_pola" required>
        <!-- Dodaj inne pola formularza w razie potrzeby -->
        <button type="submit">Wyślij</button>
    </form>
</body>
</html>
