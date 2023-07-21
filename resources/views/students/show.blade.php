@extends('layouts.app')

@section('content')
    <section style="background-color: #eee;">


            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ $studentShow->imie }}</h5>
                            <p class="text-muted mb-1">Opis</p>
                            <p class="text-muted mb-4">{{ $studentShow->miejsce_zamieszkania }}</p>

                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Imię i nazwisko<p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $studentShow->imie }} {{ $studentShow->nazwisko }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">example@example.com</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Telefon do opiekuna</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $studentShow->numer_telefonu }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Numer indeksu</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $studentShow->numer_indeksu }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Adres</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $studentShow->miejsce_zamieszkania }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
