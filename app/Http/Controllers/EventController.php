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

    public function edit(Request $request)
    {

        $eventId = $request->input('eventId');
        $newTitle = $request->input('title');
        $newStartTime = $request->input('startTime');
        $newEndTime = $request->input('endTime');

        try {

            $event = Event::findOrFail($eventId);


            $event->title = $newTitle;
            $event->start_time = $newStartTime;
            $event->end_time = $newEndTime;


            $event->save();

            return response()->json(['message' => 'Event updated successfully'], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => 'Event not found'], 404);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Error while updating event'], 500);
        }
    }

    public function index(Request $request) {
        $user = Auth::user();

        $events = $user->events;
        if($request->ajax()) {
            $user->events = event::whereDate('start_time', '>=', $request->start)->whereDate('end_time', '<=', $request->end)->get(['id', 'title', 'start_time', 'end_time']);

            return response()->json($events);
        }
        return view('calender');
    }
    public function ajax(Request $request) {
        switch ($request->type) {
            case 'add':
                $event = event::create([
                    'title' => $request->title,
                    'start_time' => $request->start,
                    'end_time' => $request->end,
                ]);
                $user = Auth::user(); // dane zalogowanego użytkownika
                $user->events()->attach($event);
                return response()->json($event);
                break;
            case 'update':
                $event = event::find($request->id)->update([
                    'title' => $request->title,
                    'start_time' => $request->start,
                    'end_time' => $request->end,
                ]);
                return response()->json($event);
                break;
            case 'delete':
                $event = event::find($request->id)->delete();
                return response()->json($event);
                break;
            default:
                break;
        }
    }
}
