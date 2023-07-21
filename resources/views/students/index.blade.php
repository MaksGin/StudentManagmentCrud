@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
            <div class="col text-end" style="margin-bottom: 20px;">
                <button type="button" class="btn btn-secondary" onclick="window.location.href = '{{ route('main') }}'">Główna</button>


            </div>

        </div>
    </div>
<h1>Lista studentów</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Imie</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Klasa</th>
            <th>Działania</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
        <tr>
            <th scope="row">{{$student->id}}</th>
            <td>{{$student->imie}}</td>
            <td>{{$student->nazwisko}}</td>
            <td>
                @if($student->classes->isEmpty())
                    Brak
                @else
                    {{$student->classes->first()->nazwa}}
                @endif
            </td>
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

    <!-- Ensure jQuery is included before this script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {

            $('tbody tr').click(function () {

                const studentId = $(this).find('th').text();
                window.location.href = '/student/' + studentId;
            });
        });
    </script>


@endsection
