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


                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
