@extends('layouts.app')

@section('content')
<h1>Lista studentów</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Imie</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Numer indeksu</th>
            <th scope="col">Miejsce zamieszkania</th>
            <th scope="col">Numer telefonu rodzica</th>
            <th>Działania</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
        <tr>
            <th scope="row">{{$student->id}}</th>
            <td>{{$student->imie}}</td>
            <td>{{$student->nazwisko}}</td>
            <td>{{$student->numer_indeksu}}</td>
            <td>{{$student->miejsce_zamieszkania}}</td>
            <td>{{$student->numer_telefonu}}</td>

            <td>
                <form action="{{ route('students.edit', $student->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-info">Edytuj studenta</button>
                </form>
            </td>
            <td>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego studenta?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Usuń</button>
                </form>
            </td>


        </tr>

        @endforeach
        </tbody>
    </table>
<button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('student.create') }}'">Dodaj studenta</button>



@endsection
