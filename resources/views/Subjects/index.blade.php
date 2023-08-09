@extends('layouts.app')

@section('content')
    <form action="{{ route('assignSubject') }}" method="post" id="assignForm">
        @csrf
        <div class="mb-3">
            <label for="przedmioty" class="form-label">Wybierz przedmiot:</label>
            <select name="przedmioty" id="przedmioty" class="form-select">
                @foreach ($subjects as $przedmiot)
                    <option value="{{ $przedmiot->id }}">{{ $przedmiot->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nauczyciele" class="form-label">Nauczyciele:</label>
            <select name="nauczyciele" id="nauczyciele" class="form-select">
                @foreach ($teachers  as $nauczyciel)
                    <option value="{{ $nauczyciel->id }}">{{ $nauczyciel->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Przypisz przedmiot</button>
    </form>
@endsection
