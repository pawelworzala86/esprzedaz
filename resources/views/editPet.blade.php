@include('includes.head')
    <form action="/api/pets" method="POST">
        @csrf
        <input type="hidden" id="id" name="id" value="{{$pet['id']??''}}">

        <div class="group">
            <label for="category">Nazwa kategorii:</label>
            <input type="text" id="category" name="category" value="{{$pet['category']['name']??''}}" required>
        </div>
        <div class="group">
            <label for="name">Nazwa zwierzaka:</label>
            <input type="text" id="name" name="name" value="{{$pet['name']??''}}" required>
        </div>
        <div class="group">
            <label for="tags">Tagi - po przecinku:</label>
            <input type="text" id="tags" name="tags" value="{{$pet['tags']??''}}" required>
        </div>
        <div class="group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="available">Dostepne</option>
                <option value="pending">Oczekujace</option>
            </select>
        </div>

        <button type="submit">Zapisz</button>
    </form>
@include('includes.footer')