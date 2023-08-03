<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{


    public function saveEvent(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $eventData = $request->only(['title', 'start', 'end']);

        $event = new Event([
            'title' => $eventData['title'],
            'start_time' => $eventData['start'],
            'end_time' => $eventData['end'],
        ]);

        $event->save();
        $user = Auth::user(); // dane zalogowanego użytkownika
        $user->events()->attach($event); //korzystajac z relacji events w modelu user przypisz stworzony event do uzytkownika

        return view('calendar.index', compact('event'));
    }

    public function getEvents(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        $events = $user->events; //korzystam z relacji events w modelu user

        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_time,
                'end' => $event->end_time,
            ];
        }

        return response()->json($formattedEvents); //formatuje eventy do formatu json
    }

    public function deleteEvent(Request $request): \Illuminate\Http\JsonResponse
    {

        $eventId = $request->input('eventId');

        try {
            $event = Event::findOrFail($eventId);
            $event->delete();
            return response()->json(['message' => 'Event deleted successfully'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

    public function edit(Request $request,Event $event ): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'editEventTitle' => 'required',
            'editEventStartTime' => 'required',
            'editEventEndTime' => 'required',

        ]);
        try {
            $event->update($validatedData);
            return response()->json(['message' => 'Event updated successfully'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Event not found'], 404);
        }
    }

}
