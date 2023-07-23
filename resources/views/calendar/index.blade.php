@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        /* Animacja rozsuwania formularza */
        @keyframes slideDown {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(0);
            }
        }

        /* Styl dla formularza */
        #eventForm {
            animation: slideDown 0.5s ease; /* Ustawiamy animację */
            display: none; /* Początkowo ukrywamy formularz */
            text-align: center;
            margin-top: 50px;
        }
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 800px; /* Maksymalna szerokość kalendarza */
            margin: 0 auto; /* Wyśrodkowanie kalendarza na stronie */
        }
        #addEventButton{
            margin-top: 50px;

        }

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var currentDate = @json($currentDate);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // ... Reszta konfiguracji kalendarza ...

                editable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventSources: [
                    // Źródło danych do pobierania wydarzeń z backendu
                    {
                        url: '/get-events', // Endpoint do pobierania wydarzeń z bazy danych
                        method: 'GET',
                        extraParams: {
                            customParam: 'customValue' // Opcjonalne dodatkowe parametry, jeśli potrzebne
                        },
                        failure: function() {
                            // Obsługa błędu, jeśli wystąpi problem z pobraniem danych
                            console.error('Błąd podczas pobierania wydarzeń z bazy danych');
                        }
                    }
                ],
                eventDrop: function(info) {
                    // Obsługa przenoszenia wydarzeń
                    // ...
                },
                eventClick: function(info) {
                    // Obsługa kliknięcia na wydarzenie
                    // ...
                },




            });

            // Obsługa kliknięcia na przycisk "Dodaj wydarzenie"
            document.getElementById('addEventButton').addEventListener('click', function() {
                document.getElementById('eventForm').style.display = 'block';
            });

            // Obsługa kliknięcia na przycisk "Zapisz" w formularzu
            document.getElementById('saveEventButton').addEventListener('click', function() {
                var eventTitle = document.getElementById('eventTitle').value;
                var eventStartTime = document.getElementById('eventStartTime').value;
                var eventEndTime = document.getElementById('eventEndTime').value;
                var eventDate = document.getElementById('eventDate').value;
                var newEvent = {
                    title: eventTitle,
                    start: eventDate + 'T' + eventStartTime,
                    end: eventDate + 'T' + eventEndTime, // Ustawiamy początkową datę jako aktualną datę
                    allDay: false // Czy wydarzenie trwa cały dzień
                };

                // Dodajemy nowe wydarzenie do kalendarza
                calendar.addEvent(newEvent);

                // Zapisujemy wydarzenie w bazie danych
                saveEventToDatabase(newEvent);

                // Czyścimy formularz i ukrywamy go
                document.getElementById('eventTitle').value = '';
                document.getElementById('eventStartTime').value = '';
                document.getElementById('eventEndTime').value = '';
                document.getElementById('eventDate').value = '';
                document.getElementById('eventForm').style.display = 'none';

            });

            calendar.render();
        });

        function saveEventToDatabase(eventData) {
            axios.post('/save-event', eventData, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
                })
                .then(function(response) {
                    console.log('Wydarzenie zapisane w bazie danych');
                })
                .catch(function(error) {
                    console.error('Błąd podczas zapisywania wydarzenia:', error);
                });
        }
    </script>
</head>
<body>

<div id='calendar'></div>
<!-- Cloudflare Pages Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script><!-- Cloudflare Pages Analytics -->
<center><button id="addEventButton" class="btn btn-primary">Dodaj wydarzenie</button></center>
{{-- Formularz do dodawania wydarzenia (możesz ukryć go początkowo za pomocą CSS) --}}

<form id="eventForm" style="display: none;" method="POST" action="/save-event">
    @csrf
    <input type="text" id="eventTitle" name="title" placeholder="Tytuł wydarzenia" required>
    <input type="date" id="eventDate" name="start" placeholder="Data wydarzenia" required>
    <input type="time" id="eventStartTime" name="start" placeholder="Godzina startu" required>
    <input type="time" id="eventEndTime" name="end" placeholder="Godzina zakończenia" required>

    <button id="saveEventButton" class="btn btn-success">Zapisz</button>
</form>



</body>
</html>
@endsection
