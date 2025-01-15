<!DOCTYPE html>
<html>
<head>
    <title>Dodawanie zwierzaka</title>
</head>
<body>
    <form action="/api/pets" method="POST">
        @csrf
        <label for="name">Nazwa zwierzaka:</label>
        <input type="text" id="name" name="name" required>

        <button type="submit">Zapisz</button>
    </form>
</body>
</html>
