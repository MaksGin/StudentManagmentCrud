@extends('layouts.app')

@section('content')
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="imie" class="form-label">Imię</label>
            <input type="text" name="imie" class="form-control" id="imie" value="{{ $student->imie }}" required>
        </div>
        <div class="mb-3">
            <label for="nazwisko" class="form-label">Nazwisko</label>
            <input type="text" name="nazwisko" class="form-control" id="nazwisko" value="{{ $student->nazwisko }}" required>
        </div>
        <div class="mb-3">
            <label for="numer_indeksu" class="form-label">Numer indeksu</label>
            <input type="text" name="numer_indeksu" class="form-control" id="numer_indeksu" value="{{ $student->numer_indeksu }}" required>
        </div>
        <div class="mb-3">
            <label for="miejsce_zamieszkania" class="form-label">Miejsce zamieszkania</label>
            <input type="text" name="miejsce_zamieszkania" class="form-control" id="miejsce_zamieszkania" value="{{ $student->miejsce_zamieszkania }}" required>
        </div>
        <div class="mb-3">
            <label for="numer_telefonu" class="form-label">Numer telefonu rodzica</label>
            <input type="text" name="numer_telefonu" class="form-control" id="numer_telefonu" value="{{ $student->numer_telefonu }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

