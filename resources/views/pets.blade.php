<!DOCTYPE html>
<html>
<head>
    <title>Table Example</title>
</head>
<body>
    <a href="/sklep/dodaj">Dodaj zwierzaka</a>
    <div class="pets">
        @foreach($pets as $row)
            <div class="pet">
                <p>{{ $row['category']['name']??'' }}</p>
                <h3>{{ $row['name']??'' }}</h3>
                <a href="/sklep/edycja/{{$row['id']??''}}">Edytuj</a>
                <a href="/sklep/usun/{{$row['id']??''}}">Usuń</a>
            </div>
        @endforeach
    </div>
    <style>
        .pets{}
        .pets .pet {
    border: 1px solid #ccc;
    margin-bottom: 16px;
}
    </style>
</body>
</html>
