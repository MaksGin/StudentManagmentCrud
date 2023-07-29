<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $uczniowie = Student::all();
        return view('teachers.studentMark',compact('uczniowie'));
    }

    public function saveMark(){

    }
}
