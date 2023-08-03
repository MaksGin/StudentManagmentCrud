@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        @keyframes slideDown {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(0);
            }
        }


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
</head>
<body>


<div id="calendar"></div>
<form id="eventForm" style="display: none;" method="POST" action="/save-event">
    @csrf
    <input type="text" id="eventTitle" name="title" placeholder="Tytuł wydarzenia" required>
    <input type="date" id="eventDate" name="start" placeholder="Data wydarzenia" required>
    <input type="time" id="eventStartTime" name="start" placeholder="Godzina startu" required>
    <input type="time" id="eventEndTime" name="end" placeholder="Godzina zakończenia" required>

    <button id="saveEventButton" class="btn btn-success">Zapisz</button>
</form>

<!-- The Modal -->
<div class="modal" id="editEventModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edytuj wydarzenie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="editEventTitle">Tytuł:</label>
                    <input type="text" class="form-control" id="editEventTitle">
                </div>
                <div class="form-group">
                    <label for="editEventStartTime">Czas rozpoczęcia:</label>
                    <input type="time" class="form-control" id="editEventStartTime">
                </div>
                <div class="form-group">
                    <label for="editEventEndTime">Czas zakończenia:</label>
                    <input type="time" class="form-control" id="editEventEndTime">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <form id="updateEventForm">
                    <input type="hidden" id="updateEventId" name="eventId">
                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                </form>
                <!-- Add the form for event deletion -->
                <form id="deleteEventForm">
                    <input type="hidden" id="deleteEventId" name="eventId">
                    <button type="submit" class="btn btn-danger">Usuń wydarzenie</button>
                </form>

            </div>
        </div>
    </div>
</div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var currentDate = @json($currentDate);
        var currentEvent;

        var editEventModal = document.getElementById('editEventModal'); // Pobieramy element modala do edycji wydarzenia
        var editEventTitle = document.getElementById('editEventTitle'); // Pobieramy pole tytułu wydarzenia w modalu
        var editEventStartTime = document.getElementById('editEventStartTime'); // Pobieramy pole czasu rozpoczęcia wydarzenia w modalu
        var editEventEndTime = document.getElementById('editEventEndTime'); // Pobieramy pole czasu zakończenia wydarzenia w modalu


        var calendar = new FullCalendar.Calendar(calendarEl, {
            contentHeight: 600,

            editable: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventSources: [
                {
                    url: '/get-events', // Endpoint do pobierania wydarzeń z bazy danych
                    method: 'GET',
                    extraParams: {
                        customParam: 'customValue'
                    },
                    failure: function() {

                        console.error('Błąd podczas pobierania wydarzeń z bazy danych');
                    }
                },
                {
                    url: '/delete-event', // Endpoint to delete events from the database
                    method: 'POST',
                    extraParams: {
                        customParam: 'customValue'
                    },
                    eventParam: 'eventId', // Specify the name of the query parameter for event ID
                    failure: function() {
                        console.error('Error while deleting events from the database');
                    },
                },
                {
                    url: '/edit-event', // Endpoint to edit events in the database
                    method: 'POST',
                    extraParams: {
                        customParam: 'customValue'
                    },
                    eventParam: 'eventId',
                    // Specify the name of the query parameter for event ID
                    failure: function() {
                        console.error('Error while editing events in the database');
                    },
                }
            ],
            eventDrop: function(info) {

            },
            eventClick: function(info) {
                currentEvent = info.event;

                editEventTitle.value = currentEvent.title;
                editEventStartTime.value = moment(currentEvent.start).format('HH:mm');
                editEventEndTime.value = moment(currentEvent.end).format('HH:mm');
                document.getElementById('deleteEventId').value = info.event.id;
                document.getElementById('updateEventId').value = info.event.id;
                // Wyświetlamy modal
                editEventModal.style.display = 'block';

            },




        });
        var cancelButton = document.querySelector('#editEventModal .modal-footer .btn-secondary');

        // Obsługa kliknięcia na przycisk "Anuluj"
        cancelButton.addEventListener('click', function() {
            // Ukryj modal
            editEventModal.style.display = 'none';
        });


        // Obsługa kliknięcia przycisku "Zapisz zmiany"
        document.getElementById('updateEventForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Pobieramy wartości z pól w modalu
            var newTitle = editEventTitle.value;
            var newStartTime = editEventStartTime.value;
            var newEndTime = editEventEndTime.value;



            currentEvent.setProp('title', newTitle);
            currentEvent.setStart(moment(currentEvent.start).format('YYYY-MM-DD') + ' ' + newStartTime + ':00');
            currentEvent.setEnd(moment(currentEvent.start).format('YYYY-MM-DD') + ' ' + newEndTime + ':00');



            // Tutaj możesz umieścić kod do aktualizacji wydarzenia w bazie danych
            const eventId = document.getElementById('updateEventId').value;
            editEventInDatabase(eventId, newTitle, newStartTime, newEndTime);

            editEventModal.style.display = 'none';
        });

        //obsluga usuwania z bazy danych
        document.getElementById('deleteEventForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Get the eventId from the hidden input field
            const eventId = document.getElementById('deleteEventId').value;
            currentEvent.remove();

            // Call the deleteEventFromDatabase function with the event's ID
            deleteEventFromDatabase(eventId);

            editEventModal.style.display = 'none';
        });




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
    function editEventInDatabase(eventId, newTitle, newStartTime, newEndTime) {
        axios
            .post(`/edit-event`, {
                eventId: eventId,
                title: newTitle,
                start: newStartTime,
                end: newEndTime
            }, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                console.log('Event updated successfully');
            })
            .catch(function(error) {
                console.error('Error while updating event:', error);
            });
    }


    function deleteEventFromDatabase(eventId) {
        axios.post(`/delete-event`, null, {
            params: {
                eventId: eventId
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(function(response) {
                console.log(response);
            })
            .catch(function(error) {
                console.error(error.response.data);
            });
    }


</script>
<center><button id="addEventButton" class="btn btn-primary">Dodaj wydarzenie</button></center>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</html>
@endsection
