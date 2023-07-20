@extends('layouts.app')

@section('content')
    <h1>Lista klas</h1>

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-end" style="margin-bottom: 20px;">
                <button type="button" class="btn btn-secondary" onclick="window.location.href = '{{ route('main') }}'">Główna</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href = '{{ route('classes.create') }}'">Dodaj klasę</button>

            </div>

        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Rok szkolny</th>
            <th scope="col">Profil</th>
            <th scope="col">Wychowawca</th>
            <th scope="col">Liczba uczniów</th>
            <th scope="col">Godziny lekcyjne</th>
            <th>Działania</th>
        </tr>
        </thead>
        <tbody>
        @foreach($classes as $class)
            <tr data-url="{{ route('classes.show', $class->id) }}">
                <th scope="row">{{$class->id}}</th>
                <td>{{$class->nazwa}}</td>
                <td>{{$class->rok_szkolny}}</td>
                <td>{{$class->profil}}</td>
                <td>{{$class->wychowawca}}</td>
                <td>{{$class->liczba_uczniow}}</td>
                <td>{{$class->godziny_lekcyjne}}</td>

                <td>
                    <a href="{{ route('classes.edit', ['class' => $class->id]) }}" class="btn btn-secondary">
                        Edytuj klasę
                    </a>
                </td>
                <!-- poprawic przycisk usuwania klasy, usuwanie studenta dziala -->
                <td>
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); if(confirm('Czy na pewno chcesz usunąć klasę?')) document.getElementById('delete-form-{{ $class->id }}').submit();">
                        Usuń
                    </a>
                    <form id="delete-form-{{ $class->id }}" action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <script>
        // Pobierz wszystkie wiersze tabeli
        const rows = document.querySelectorAll('tr[data-url]');

        // Dla każdego wiersza dodaj nasłuchiwanie na zdarzenie kliknięcia
        rows.forEach(row => {
            row.addEventListener('click', () => {
                // Pobierz adres URL z atrybutu data-url
                const url = row.getAttribute('data-url');

                // Przekieruj użytkownika na adres URL
                window.location.href = url;
            });
        });
    </script>


@endsection
