@extends('layouts.app')

@section('content')
    <h1>Klasa: {{$class->nazwa}}</h1>

    <h3>Lista uczniów: </h3>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Imie</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Numer Indeksu</th>
            <th>Działania</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
            <td>{{$student->imie}}</td>
            <td>{{$student->nazwisko}}</td>
            <td>{{$student->numer_indeksu}}</td>
            </tr>
        @endforeach


        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <h3>Dodaj ucznia</h3>
                    <form action="{{route('classes.addStudent',$class->id)}}" method="POST">
                    @csrf
                        <select name="student_id" id="student_id">
                            <option value="Wybierz ucznia..."></option>
                            @foreach($allStudents as $student)
                                @if(!$student->class)
                                    <option value="{{$student->id}}">{{$student->imie}}</option>
                                @endif
                            @endforeach
                        </select>
    <button type="submit">Dodaj ucznia</button>
                    </form>

            </div>

    </div>

    </div>



{{-- Tutaj możesz dodać formularz do dodawania nowego ucznia --}}
@endsection
