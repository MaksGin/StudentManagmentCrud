@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>

    <title>Lista Studentów</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<body>
<h1>Lista Studentów</h1>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th style="display: none;">Id</th>
        <th>Imie</th>
        <th>Nazwisko</th>
        <th>Klasa</th>
        <th>Edytuj</th>
        <th>Usun</th>

    </tr>
    </thead>

    <tbody>
    @foreach($students as $student)
    <tr>
        <th style="display: none;">{{$student->id}}</th>
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
<!-- Ensure jQuery is included before this script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Click event for table rows
        $('tbody tr').click(function () {
            const studentId = $(this).find('th').text();
            window.location.href = '/student/' + studentId;
        });

        // Click event for delete buttons
        $('tbody tr .btn-danger').click(function (event) {
            // Stop the propagation of the click event
            event.stopPropagation();
        });
    });
</script>
<button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('student.create') }}'">Dodaj studenta</button>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
    } );
    } );
</script>

</body>
</html>
@endsection
