@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przypisanie studenta do użytkownika</title>
    <style>
        /* Dodaj swoje style CSS tutaj, aby dostosować wygląd formularza */
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Przypisanie studenta do użytkownika</h2>
    <form action="{{ route('assignStudent') }}" method="post" id="assignForm">
        @csrf <!-- Dodajemy pole CSRF token dla bezpieczeństwa -->
        <div class="form-group">
            <label for="student_id" class="form-label">Wybierz studenta:</label>
            <select name="student_id" id="student_id" class="form-control">
                <!-- Tutaj możesz wygenerować opcje z listy studentów z bazy danych -->
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->imie }} {{ $student->nazwisko }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id" class="form-label">Wybierz użytkownika:</label>
            <select name="user_id" id="user_id" class="form-control">
                <!-- Tutaj możesz wygenerować opcje z listy użytkowników z bazy danych -->
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->email }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Przypisz konto studentowi</button>
    </form>
</div>

<script>
    // Dodajemy animacje po załadowaniu strony
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('assignForm');
        form.style.opacity = 0;
        form.style.transform = 'translateY(-20px)';
        form.style.transition = 'opacity 1s, transform 1s';
        setTimeout(function () {
            form.style.opacity = 1;
            form.style.transform = 'translateY(0)';
        }, 200);
    });

    // Dodajemy animacje po kliknięciu przycisku "Przypisz studenta do użytkownika"
    const submitButton = document.querySelector('input[type="submit"]');
    submitButton.addEventListener('click', function (event) {
        event.preventDefault(); // Blokujemy domyślną akcję formularza (przekierowanie)
        const form = document.getElementById('assignForm');
        form.style.opacity = 0;
        form.style.transform = 'translateY(20px)';
        setTimeout(function () {
            form.submit(); // Ręcznie wysyłamy formularz po animacji
        }, 1000);
    });
</script>
</body>
</html>
@endsection
