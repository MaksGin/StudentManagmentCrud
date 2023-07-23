<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Event;
use App\Models\Student;
use http\Env\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
class CalendarController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $currentDate = Carbon::now();

        $wydarzenia = array();
        $events = Event::all();

        foreach ($events as $event){
            $wydarzenia[] = [
                'title' => $event->title,
                'start' => $event->start_time,
                'end' => $event -> end_time,
            ];
        }
        return view('calendar.index',compact('currentDate','wydarzenia'));
    }


}
