@extends('layouts.app')

@section('content')


    <form action="{{ route('grade.store') }}" method="POST">
        @csrf

        <label for="uczen">Wybierz ucznia:</label>
        <select name="uczen" id="uczen" multiple>
            @foreach ($studentsInClass as $uczen)

                <option value="{{ $uczen->id }}">{{ $uczen->imie }} {{ $uczen->nazwisko }}</option>
            @endforeach
        </select>
        <label for="przedmioty">Wybierz przedmiot:</label>
        <select name="przedmioty" id="przedmioty">
            @foreach ($przedmioty as $przedmiot)
                <option value="{{ $przedmiot->id }}">{{ $przedmiot->name }}</option>
            @endforeach
        </select>

        <label for="ocena">Ocena:</label>
        <input type="number" name="ocena" id="ocena" min="1" max="6" required>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


@endsection
