@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przypisanie studenta do użytkownika</title>
    <style>
        .form-group{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Załóż konto dla studenta</h2>
    <form action="{{ route('assignStudent') }}" method="post" id="assignForm">
        @csrf
        <div class="form-group">
            <label for="student_id" class="form-label">Wybierz studenta:</label>
            <select name="student_id" id="student_id" class="form-control">

                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->imie }} {{ $student->nazwisko }}</option>
                @endforeach
            </select>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Imie:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hasło:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Potwierdź hasło:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Rola:</strong>
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
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
