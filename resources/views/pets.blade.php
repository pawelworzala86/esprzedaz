@include('includes.head')
    <a href="/sklep">Sklep</a>
    <a href="/sklep/dodaj">Dodaj zwierzaka</a>

    @if ($category!=null)
    <a href="/sklep/status/dostepne/kategoria/{{ $category }}">Dostepne</a>
    <a href="/sklep/status/oczekujace/kategoria/{{ $category }}">Oczekujące</a>
    <a href="/sklep/status/sprzedane/kategoria/{{ $category }}">Sprzedane</a
    @else
    <a href="/sklep/status/dostepne">Dostepne</a>
    <a href="/sklep/status/oczekujace">Oczekujące</a>
    <a href="/sklep/status/sprzedane">Sprzedane</a>
    @endif

    <div class="pets">
        @foreach($pets as $pet)
            <div class="pet">
                <a href="/sklep/status/{{$status}}/kategoria/{{ $pet['category']['name']??'' }}"><p>{{ $pet['category']['name']??'' }}</p></a>
                <h3>{{ $pet['name']??'brak nazwy' }}</h3>
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
@include('includes.footer')