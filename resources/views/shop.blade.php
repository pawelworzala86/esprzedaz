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
                <h3>{{ $row['name'] }}</h3>
            </div>
        @endforeach
    </div>
</body>
</html>
