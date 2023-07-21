@extends('layouts.app')

@section('content')
    <h1>Lista nowych studentów</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Imie</th>
            <th scope="col">Nazwisko</th>
            <th>Działania</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            @if($student->classes->isEmpty())
                <tr>
                    <th scope="row">{{$student->id}}</th>
                    <td>{{$student->imie}}</td>
                    <td>{{$student->nazwisko}}</td>
                    <td>
                        <!-- Add action buttons here if needed -->
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>


@endsection
