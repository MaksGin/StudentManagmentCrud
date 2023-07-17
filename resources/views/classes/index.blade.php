@extends('layouts.app')

@section('content')
    <h1>Lista klas</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Rok szkolny</th>
            <th scope="col">Profil</th>
            <th scope="col">Wychowawca</th>
            <th scope="col">Liczba uczniów</th>
            <th scope="col">Godziny lekcyjne</th>
            <th>Działania</th>
        </tr>
        </thead>
        <tbody>
        @foreach($classes as $class)
            <tr>
                <th scope="row">{{$class->id}}</th>
                <td>{{$class->nazwa}}</td>
                <td>{{$class->rok_szkolny}}</td>
                <td>{{$class->profil}}</td>
                <td>{{$class->wychowawca}}</td>
                <td>{{$class->liczba_uczniow}}</td>
                <td>{{$class->godziny_lekcyjne}}</td>




            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
