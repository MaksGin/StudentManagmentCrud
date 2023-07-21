<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use http\Env\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class CalendarController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('calendar.index');
    }


}
