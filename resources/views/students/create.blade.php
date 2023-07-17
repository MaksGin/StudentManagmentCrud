@extends('layouts.app')

@section('content')

    <form action="{{ route('student.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="imie" class="form-label">Imię</label>
            <input type="text" name="imie" class="form-control" id="imie" required>
        </div>
        <div class="mb-3">
            <label for="nazwisko" class="form-label">Nazwisko</label>
            <input type="text" name="nazwisko" class="form-control" id="nazwisko" required>
        </div>
        <div class="mb-3">
            <label for="numer_indeksu" class="form-label">Numer indeksu</label>
            <input type="text" name="numer_indeksu" class="form-control" id="numer_indeksu" required>
        </div>
        <div class="mb-3">
            <label for="miejsce_zamieszkania" class="form-label">Miejsce zamieszkania</label>
            <input type="text" name="miejsce_zamieszkania" class="form-control" id="miejsce_zamieszkania" required>
        </div>
        <div class="mb-3">
            <label for="numer_telefonu" class="form-label">Numer telefonu rodzica</label>
            <input type="text" name="numer_telefonu" class="form-control" id="numer_telefonu" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>






@endsection
