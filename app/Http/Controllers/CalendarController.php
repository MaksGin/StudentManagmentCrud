<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Event;
use App\Models\Student;
use http\Env\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
class CalendarController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $currentDate = Carbon::now();
        $user = Auth::user();

        $wydarzenia = array();
        $events = $user->events; // Pobierz wydarzenia przypisane do zalogowanego użytkownika

        foreach ($events as $event) {
            $wydarzenia[] = [
                'title' => $event->title,
                'start' => $event->start_time,
                'end' => $event->end_time,
            ];
        }

        return view('calendar.index', compact('currentDate', 'wydarzenia'));
    }




}
