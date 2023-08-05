@extends('layouts.app')

@section('content')
<head>

    <style>
    .uczenimg{
        margin: 20px;
    }

    </style>
</head>
    <?php

    date_default_timezone_set('Europe/Warsaw'); // Ustawiamy strefę czasową

    $aktualnaData = date('Y-m-d'); // Aktualna data w formacie RRRR-MM-DD
    $aktualnaGodzina = date('H:i:s'); // Aktualna godzina w formacie GG:MM:SS



    ?>
    @auth <!-- Sprawdzenie, czy użytkownik jest zalogowany -->
@role('Uczen')

    <div class="row row-cols-3 g-3">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="calendar1">
                    <div class="col-md-4" >
                        <img
                            src="calendar.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start uczenimg"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Kalendarz</h5>
                                <p class="card-text">
                                    Twórz wydarzenia żeby o niczym nie zapomnieć :)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="ocenyPanel">
                    <div class="col-md-4" >
                        <img
                            src="grade.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start uczenimg"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Oceny</h5>
                                <p class="card-text">
                                    Sprawdz swoje oceny :)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="profilePanel">
                    <div class="col-md-4" >
                        <img
                            src="UczenUser.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start uczenimg"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Profil</h5>
                                <p class="card-text">
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elserole('Admin|Wychowawca1a|Wychowawca1b|Wychowawca1c')
    <div class="container">
       <center><h5 class="card-title text-justify" style="font-weight: bold; margin-top: 10px; margin-bottom: 20px;">Dzisiejsza data: {{$aktualnaData}}</h5></center>
    </div>
    <div class="row row-cols-3 g-3">
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="manageStudentCard" >
                    <div class="col-md-4" >
                        <img
                            src="studentManage.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Zarządzaj studentem</h5>
                            <p class="card-text">
                                Lista studentów przypisane do nich klasy z możliwością usuwania edycji i tworzenia nowego studenta
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('enter-grades')
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="WpiszOceny">
                    <div class="col-md-4">
                        <img
                            src="enterGrades.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Wpisz oceny</h5>
                            <p class="card-text">
                                Dodaj oceny z kartkówek/sprawdzianów ze swojego przedmiotu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="allClasses">
                    <div class="col-md-4">
                        <img
                            src="communication.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Lista wszystkich klas</h5>
                            <p class="card-text">
                                Lista wszystkich klas w szkole.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="newStudents">
                    <div class="col-md-4">
                        <img
                            src="add.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nowi studenci</h5>
                            <p class="card-text">
                                Tutaj znajduje się lista nowych studentów przyjętych po rekrutacji, nie przypisanych do klasy.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="twojaKlasa">
                    <div class="col-md-4">
                        <img
                            src="elearning.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Twoja Klasa</h5>
                            <p class="card-text">
                                Informacje o klasie która uczysz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0" id="calendar">
                    <div class="col-md-4">
                        <img
                            src="calendar.png"
                            alt="Trendy Pants and Shoes"
                            class="img-fluid rounded-start"
                        />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Kalendarz</h5>
                            <p class="card-text">
                                Twórz wydarzenia żeby o niczym nie zapomnieć :)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endrole
@endauth
<script>
        const loggedInUserId = {{ auth()->user()->id }};

        function elementExists(elementId) {
            return !!document.getElementById(elementId);
        }
        if (elementExists('WpiszOceny')) {
            const WpiszOceny = document.getElementById('WpiszOceny');
            WpiszOceny.addEventListener('click', function() {
                // Use the 'loggedInUserId' variable to construct the URL
                window.location.href = `/mark/student`;
            });
        }
        if (elementExists('ocenyPanel')) {
            const ocenyPanel = document.getElementById('ocenyPanel');
            ocenyPanel.addEventListener('click', function() {
                window.location.href = '/gradesList';
            });
        }
        if (elementExists('profilePanel')) {
            const profilePanel = document.getElementById('profilePanel');
            profilePanel.addEventListener('click', function() {
                // Use the 'loggedInUserId' variable to construct the URL
                window.location.href = `/student/${loggedInUserId}/profile`;
            });
        }
        if (elementExists('calendar1')) {
            const calendar1 = document.getElementById('calendar1');
            calendar1.addEventListener('click', function() {
                // Use the 'loggedInUserId' variable to construct the URL
                window.location.href = `/calendar`;
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
