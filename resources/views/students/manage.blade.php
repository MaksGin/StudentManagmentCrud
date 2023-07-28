@extends('layouts.app')

@section('content')
    <h2>Przypisanie studenta do użytkownika</h2>
    <form action="{{ route('assignStudent') }}" method="post">
        @csrf <!-- Dodajemy pole CSRF token dla bezpieczeństwa -->
        <label for="student_id">Wybierz studenta:</label>

        <select name="student_id" id="student_id">
            <!-- Tutaj możesz wygenerować opcje z listy studentów z bazy danych -->
            @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->imie }} {{ $student->nazwisko }}</option>
            @endforeach

        </select>

        <select name="user_id" id="user_id">
            <!-- Tutaj możesz wygenerować opcje z listy studentów z bazy danych -->
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->email }}</option>
            @endforeach

        </select>

        <input type="submit" value="Przypisz studenta do użytkownika">
    </form>

@endsection
