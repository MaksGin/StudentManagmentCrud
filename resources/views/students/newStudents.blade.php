@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>

    <title>Nowi studenci</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<body>
<h1>Nowi studenci</h1>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th style="display: none;">Id</th>
        <th>Imie</th>
        <th>Nazwisko</th>

    </tr>
    </thead>

    <tbody>
    @foreach($students as $student)
        @if($student->classes->isEmpty())
            <tr>
                <td style="display: none;">{{$student->id}}</td>
                <td>{{$student->imie}}</td>
                <td>{{$student->nazwisko}}</td>

            </tr>
        @endif
    @endforeach
    </tbody>
</table>
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
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pl.json',
            },
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>

</body>
</html>
@endsection

