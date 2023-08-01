@extends('layouts.app')

@section('content')


    <form action="{{ route('grade.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="uczen" class="form-label">Wybierz ucznia:</label>
            <select name="uczen_id" id="uczen_id" class="form-select">
                @foreach ($studentsInClass as $uczen)

                    <option value="{{ $uczen->id }}">{{ $uczen->imie }} {{ $uczen->nazwisko }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="przedmioty" class="form-label">Wybierz przedmiot:</label>
            <select name="przedmioty" id="przedmioty" class="form-select">
                @foreach ($przedmioty as $przedmiot)
                    <option value="{{ $przedmiot->id }}">{{ $przedmiot->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">

                </div>
                <div class="col">
                    <div class="mb-3">
                        <input type="checkbox" name="ocena" class="btn-check" id="ocena1" value="1" autocomplete="off">
                        <label class="btn btn-danger" for="ocena1">1</label>
                        <input type="checkbox" name="ocena" class="btn-check" id="ocena2" value="2" autocomplete="off">
                        <label class="btn btn-warning" for="ocena2">2</label>
                        <input type="checkbox" name="ocena" class="btn-check" id="ocena3" value="3" autocomplete="off">
                        <label class="btn btn-secondary" for="ocena3">3</label>
                        <input type="checkbox" name="ocena" class="btn-check" id="ocena4" value="4" autocomplete="off">
                        <label class="btn btn-info" for="ocena4">4</label>
                        <input type="checkbox" name="ocena" class="btn-check" id="ocena5" value="5"  autocomplete="off">
                        <label class="btn btn-success" for="ocena5">5</label>
                        <input type="checkbox" name="ocena" class="btn-check" id="ocena6" value="6"  autocomplete="off">
                        <label class="btn btn-light" for="ocena6">6</label>
                    </div>
                </div>
                <div class="col">

                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    <script>
        const checkboxes = document.querySelectorAll('.btn-check');
        const ocenaInput = document.querySelector('input[name="ocena"]');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', () => {
                if (checkbox.checked) {
                    ocenaInput.value = checkbox.value;
                } else {
                    ocenaInput.value = '';
                }
            });
        });
    </script>

@endsection
