@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Klasa: {{$class->nazwa}}</h1>
                <h6>Liczba uczniów w klasie: {{$class->students->count()}}  </h6></div>
            <div class="col text-end"  style="margin-bottom: 20px;">

                <button type="button" class="btn btn-secondary" onclick="window.location.href = '{{ route('classes.showClass') }}'">Twoja klasa</button>


            </div>
            <h3>Lista uczniów: </h3>
        </div>
    </div>



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
            <td>
                <form action="{{ route('deleteStudentFromClass', $student->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Usuń</button>
                </form>
            </td>
            </tr>
        @endforeach


        </tbody>
    </table>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Dodaj ucznia do klasy: {{$class->nazwa}}</h3>
                <form action="{{route('classes.addStudent',$class->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <select class="form-select" name="student_id" id="student_id">
                        <option value="Wybierz ucznia..."></option>
                        @foreach($allStudents as $student)
                            @if(!$student->class)
                                <option value="{{$student->id}}">{{$student->imie}} {{$student->nazwisko}}<br> Numer indeksu: {{$student->numer_indeksu}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Dodaj ucznia</button>
                </form></div>
            <div class="col"></div>
            <div class="col"></div>
    </div>

    </div>



{{-- Tutaj możesz dodać formularz do dodawania nowego ucznia --}}
@endsection
