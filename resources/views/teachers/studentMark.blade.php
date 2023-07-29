@extends('layouts.app')

@section('content')
    <form action="{{ route('save_mark') }}" method="POST">
        @csrf

        <label for="uczen">Wybierz ucznia:</label>
        <select name="uczen" id="uczen">
            @foreach ($uczniowie as $uczen)
                <option value="{{ $uczen->id }}">{{ $uczen->imie }} {{ $uczen->nazwisko }}</option>
            @endforeach
        </select>

        <label for="ocena">Ocena:</label>
        <input type="number" name="ocena" id="ocena" min="1" max="6" required>

        <button type="submit">Zapisz ocenę</button>
    </form>


@endsection
