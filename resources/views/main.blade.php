@extends('layouts.app')

@section('content')

    <?php

    date_default_timezone_set('Europe/Warsaw'); // Ustawiamy strefę czasową

    $aktualnaData = date('Y-m-d'); // Aktualna data w formacie RRRR-MM-DD
    $aktualnaGodzina = date('H:i:s'); // Aktualna godzina w formacie GG:MM:SS



    ?>
    @auth <!-- Sprawdzenie, czy użytkownik jest zalogowany -->
    @role('Uczen')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mb-3" style="border: 2px solid black;"  id="ocenyPanel">
                    <img src="OcenyPanel.png" class="card-img-top" alt="..."  style="width: 30%; margin: 0 auto; padding: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">Oceny</h5>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">Przejrzyj twoje oceny</small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="border: 2px solid black;" id="profilePanel">
                    <img src="profilePic.png" class="card-img-top" alt="..."  style="width: 30%; margin: 0 auto; padding: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">Twój profil</h5>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">Informacje o Tobie</small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3" style="border: 2px solid black;" id="thirdPanel">
                    <img src="profilePic.png" class="card-img-top" alt="..."  style="width: 30%; margin: 0 auto; padding: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">Oceny</h5>
                        <p class="card-text"></p>
                        <p class="card-text"><small class="text-muted">coś</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elserole('Admin')
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
                    <p>Dzisiejsza data: {{$aktualnaData}}</p>
                    <p></p>


                    @auth
                        <h1>Witaj, {{ auth()->user()->name }}!</h1>
                    @endauth
                </div>
            </div>

            <div class="card bg-danger text-white text-center my-4">
                <div class="card-body">
                    <h5 class="card-title">Panel title</h5>
                    <p>This card has a regular title and short paragraphy of text below it.</p>
                    <p><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card bg-success text-white mb-4" id="allClasses">
                <div class="card-body">
                    <h5 class="card-title">Lista wszystkich klas</h5>
                    <p>Wejdz aby zobaczyć listę wszystkich klas w szkole</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">

            <div class="card bg-warning text-white text-center mb-4" id="newStudents">
                <div class="card-body">
                    <h5 class="card-title">Nowi studenci</h5>
                    <p>Lista nowych studentów</p>
                </div>
            </div>

            <div class="card bg-dark text-white mb-4" id="twojaKlasa">
                <div class="card-body">
                    <h5 class="card-title">Twoja klasa</h5>
                    <p>przeglądaj listę uczniów w twojej klasie</p>
                    <p><small>Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card bg-secondary text-white text-end mb-4" id="calendar">
                <div class="card-body">
                    <h5 class="card-title">Kalendarz</h5>
                    <p>sprawdz nadchodzące eventy</p>
                    <p><small>Last updated 3 mins ago</small></p></div>
            </div>
        </div>
    </div>
    @endrole
@endauth
    <script>

        function elementExists(elementId) {
            return !!document.getElementById(elementId);
        }

        if (elementExists('ocenyPanel')) {
            const ocenyPanel = document.getElementById('ocenyPanel');
            ocenyPanel.addEventListener('click', function() {
                window.location.href = '/gradesList';
            });
        }

        const manageStudentCard = document.getElementById('manageStudentCard');
        manageStudentCard.addEventListener('click', function() {
            window.location.href = '/StudentList';
        });

        const listaKlas = document.getElementById('allClasses');
        listaKlas.addEventListener('click', function() {
            window.location.href = '/listaKlas';
        });

        const newStudents = document.getElementById('newStudents');
        newStudents.addEventListener('click', function() {
            window.location.href = '/newStudents';
        });

        const calendar = document.getElementById('calendar');
        calendar.addEventListener('click', function() {
            window.location.href = '/calendar';
        });

        const twojaKlasa = document.getElementById('twojaKlasa');
        twojaKlasa.addEventListener('click', function() {
            window.location.href = '/twojaKlasa';
        });

    </script>
@endsection
