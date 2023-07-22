@extends('layouts.app')


@section('content')

    <h2>Dodaj permisje</h2>
    <form action="{{ route('permissions.store') }}" method="post">
        @csrf
        <label for="name">Nazwa uprawnienia:</label>
        <input type="text" name="name" id="name" required>
        <br>

        <p></p>
        <button type="submit" class="btn btn-primary">Dodaj uprawnienie</button>
    </form>


@endsection
