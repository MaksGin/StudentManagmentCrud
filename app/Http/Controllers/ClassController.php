<?php

namespace App\Http\Controllers;

use App\Models\Classes;

class ClassController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $classes = Classes::all();
        return view('classes.index',compact('classes'));
    }
}
