<!DOCTYPE html>
<html>
<head>
    <title>Dodawanie zwierzaka</title>
</head>
<body>
    <form action="/api/pets" method="POST">
        @csrf
        <input type="hidden" id="id" name="id" value="{{$pet['id']??''}}">

        <label for="category">Nazwa kategorii:</label>
        <input type="text" id="category" name="category" value="{{$pet['category']['name']??''}}" required>

        <label for="name">Nazwa zwierzaka:</label>
        <input type="text" id="name" name="name" value="{{$pet['name']??''}}" required>

        <button type="submit">Zapisz</button>
    </form>
</body>
</html>
