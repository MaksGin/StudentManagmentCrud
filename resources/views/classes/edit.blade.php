@extends('layouts.app')

@section('content')
    <form action="{{ route('classes.update', ['class' => $class->id]) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label for="nazwa" class="form-label">Nazwa klasy:</label>
            <input type="text" name="nazwa" class="form-control" id="nazwa" value="{{$class->nazwa}}" required>
        </div>
        <div class="mb-3">
            <label for="rok_szkolny" class="form-label">Rok szkolny</label>
            <input type="text" name="rok_szkolny" class="form-control" id="rok_szkolny" value="{{$class->rok_szkolny}}" required>
        </div>
        <div class="mb-3">
            <label for="profil" class="form-label">Profil</label>
            <input type="text" name="profil" class="form-control" id="profil" value="{{$class->profil}}" required>
        </div>
        <div class="mb-3">
            <label for="wychowawca" class="form-label">Wychowawca</label>
            <input type="text" name="wychowawca" class="form-control" id="wychowawca" value="{{$class->wychowawca}}" required>
        </div>
        <div class="mb-3">
            <label for="liczba_uczniow" class="form-label">Liczba uczniow</label>
            <input type="text" name="liczba_uczniow" class="form-control" id="liczba_uczniow" value="{{$class->liczba_uczniow}}" required>
        </div>
        <div class="mb-3">
            <label for="godziny_lekcyjne" class="form-label">Godziny lekcyjne</label>
            <input type="text" name="godziny_lekcyjne" class="form-control" id="godziny_lekcyjne" value="{{$class->godziny_lekcyjne}}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
