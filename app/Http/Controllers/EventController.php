<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function saveEvent(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $eventData = $request->only(['title', 'start', 'end']);

        $event = new Event([
            'title' => $eventData['title'],
            'start_time' => $eventData['start'],
            'end_time' => $eventData['end']
        ]);

        $event->save();
        return view('calendar.index',compact('event'));
    }
    public function getEvents(): \Illuminate\Http\JsonResponse
    {
        $events = Event::all();

        $formattedEvents = [];

        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event->title,
                'start' => $event->start_time,
                'end' => $event->end_time,

            ];
        }

        return response()->json($formattedEvents);
    }

}
