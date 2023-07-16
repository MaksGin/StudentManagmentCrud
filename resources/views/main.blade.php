@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">

            <div class="card bg-success text-white text-center mb-4" id="manageStudentCard">
                <div class="card-body">
                    <h5 class="card-title">Manage Student</h5>

                </div>
            </div>

            <div class="card bg-info text-white text-end mb-4">
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </div>
            </div>
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Panel title</h5>
                    <p>This card has supporting text below as a natural lead-in to additional content.</p>
                    <p><small>Last updated 3 mins ago</small></p></div>
            </div>
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">

            <div class="card bg-primary text-white mb-4 text-end">
                <div class="card-body">
                    <p>Tutaj pojawi sie aktualna data i godzina</p>
                    <p>Panel powitalny</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
                </div>
            </div>

            <div class="card bg-danger text-white text-center my-4">
                <div class="card-body">
                    <h5 class="card-title">Panel title</h5>
                    <p>This card has a regular title and short paragraphy of text below it.</p>
                    <p><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Panel title that wraps to a new line</h5>
                    <p>This is a longer card with supporting text below as a natural lead-in to additional content.
                        This content is a little bit longer.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">

            <div class="card bg-warning text-white text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Nowi studenci</h5>
                    <p>Lista nowych studentów</p>
                </div>
            </div>

            <div class="card bg-dark text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Twoja klasa</h5>
                    <p>przeglądaj listę uczniów w twojej klasie</p>
                    <p><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card bg-secondary text-white text-end mb-4">
                <div class="card-body">
                    <h5 class="card-title">Kalendarz</h5>
                    <p>sprawdz nadchodzące eventy</p>
                    <p><small>Last updated 3 mins ago</small></p></div>
            </div>
        </div>
    </div>
    <script>
        // Użyj Vanilla JS lub jQuery, aby obsłużyć kliknięcie na divie
        // Vanilla JS:
        const manageStudentCard = document.getElementById('manageStudentCard');
        manageStudentCard.addEventListener('click', function() {
            window.location.href = '/products';
        });

        // jQuery:
        // $('#manageStudentCard').click(function() {
        //     window.location.href = '/managestudent';
        // });
    </script>
@endsection
