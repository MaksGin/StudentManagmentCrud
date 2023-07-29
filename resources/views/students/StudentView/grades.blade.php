@extends('layouts.app')

@section('content')
<h1>Oceny</h1>

@php
    $matematykaOceny = collect();
@endphp

@foreach ($oceny as $ocena)
    <p>Przedmiot: {{ $ocena->subject->name }}</p>
    <p>Ocena: {{$ocena->grade}}</p>
    <hr>
@endforeach









@endsection
