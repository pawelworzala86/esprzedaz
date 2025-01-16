<!DOCTYPE html>
<html>
<head>
    <title>Table Example</title>
</head>
<body>
    <a href="/sklep/dodaj">Dodaj zwierzaka</a>
    <div class="pets">
        @foreach($pets as $pet)
            <div class="pet">
                <p>{{ $pet['category']['name']??'' }}</p>
                <h3>{{ $pet['name']??'' }}</h3>
                <div class="tags">
                    @foreach($pet['tags']??[] as $tag)
                        <p>{{ $tag['name']??'' }}</p>
                    @endforeach
                </div>
                <a href="/sklep/edycja/{{$pet['id']??''}}">Edytuj</a>
                <a href="/sklep/usun/{{$pet['id']??''}}">Usuń</a>
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
