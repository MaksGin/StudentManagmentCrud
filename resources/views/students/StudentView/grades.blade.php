@extends('layouts.app')

@section('content')
<h1>Oceny</h1>

@php
    $matematykaOceny = collect();
@endphp

@php
    $currentSubject = null; // zmienna do sledzenia nazwy przedmiotu
@endphp

@foreach ($oceny as $ocena)

    @if ($ocena->subject->name !== $currentSubject)
        @php
            $currentSubject = $ocena->subject->name; //jesli przedmiot sie zmieni wypisujemy nowy nagłówek
        @endphp
        <hr>
        <h3>Przedmiot: {{ $currentSubject }}</h3>

    @endif
    {{ $ocena->grade }},

@endforeach










@endsection
