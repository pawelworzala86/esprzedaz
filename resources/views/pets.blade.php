<!DOCTYPE html>
<html>
<head>
    <title>Table Example</title>
</head>
<body>
    <a href="/sklep/dodaj">Dodaj zwierzaka</a>
    <div>
        @foreach($pets as $row)
            <div>
                <h3>{{ $row['name']??'' }}</h3>
                <a href="/sklep/edycja/{{$row['id']??''}}">Edytuj</a>
            </div>
        @endforeach
    </div>
</body>
</html>
