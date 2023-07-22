@extends('layouts.app')

@section('content')
    <h1>Twoja klasa</h1>

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>
    </div>
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
                <td>{{$class->students->count()}} / {{$class->liczba_uczniow}}</td>
                <td>{{$class->godziny_lekcyjne}}</td>



                <td>
                    <a href="{{ route('classes.edit', ['class' => $class->id]) }}" class="btn btn-secondary">
                        Edytuj klasę
                    </a>
                </td>

                <td>
                    <form action="{{ route('classes.destroy', ['class' => $class->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>


            </tr>
        @endforeach

        </tbody>
    </table>
    <!-- Ensure jQuery is included before this script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {

            $('tbody tr').click(function () {

                const classId = $(this).find('th').text();
                window.location.href = '/classes/' + classId;
            });
        });
    </script>



@endsection
