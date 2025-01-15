<!DOCTYPE html>
<html>
<head>
    <title>Dodawanie zwierzaka</title>
</head>
<body>
    <h2>Czy chcesz usunąć zwierzaka ze sklepu?</h2>

    <a href="/sklep/usun/{{$pet['id']??''}}/confirm"><button>Usuń</button></a>
    <a href="/sklep"><button>Anuluj</button></a>
</body>
</html>
