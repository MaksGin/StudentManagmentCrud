@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2023-07-07',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'All Day Event',
                        start: '2023-07-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2023-07-07',
                        end: '2023-07-10'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2023-07-09T16:00:00'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2023-07-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2023-07-11',
                        end: '2023-07-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2023-07-12T10:30:00',
                        end: '2023-07-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2023-07-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2023-07-12T14:30:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2023-07-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'https://google.com/',
                        start: '2023-07-28'
                    }
                ],
                editable: true, // Umożliwia przenoszenie wydarzeń
                eventDrop: function(info) {
                    var event = info.event;

                    // Aktualizuj wydarzenie na backendzie lub w odpowiednich danych

                    console.log('Przeniesiono wydarzenie:', event.title, event.start.toISOString());
                },
                eventClick: function(info) {
                    var event = info.event;

                    // Obsłuż kliknięcie na wydarzenie
                    console.log('Kliknięto na wydarzenie:', event.title);
                    alert('Kliknięto na wydarzenie: ' + event.title);
                    console.log('Kliknięto na wydarzenie:', event.title);
                }
            });

            calendar.render();
        });

    </script>
</head>
<body>
<div id='calendar'></div>
<!-- Cloudflare Pages Analytics --><script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script><!-- Cloudflare Pages Analytics -->
</body>
</html>
@endsection
