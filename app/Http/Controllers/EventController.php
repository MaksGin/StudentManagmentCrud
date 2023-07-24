<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
                'title' => $event->title,
                'start' => $event->start_time,
                'end' => $event->end_time,
            ];
        }

        return response()->json($formattedEvents); //formatuje eventy do formatu json
    }

}
