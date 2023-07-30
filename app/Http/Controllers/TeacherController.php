<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $classrooms = $user->classes;
        $studentsInClass = collect();
        foreach ($classrooms as $classroom) {
            $studentsInClass = $studentsInClass->merge($classroom->students);
        }
        // Pobieramy ID studentów z klas, za pomocą metody pluck()
        $studentIdsInClass = $studentsInClass->pluck('id');

        //naprawic problem pomiedzy user_id a student_id poniewaz roznia i przez ta sa bledy
        $przedmioty = $user->subject;
        return view('teachers.studentMark',compact('studentsInClass','przedmioty','studentIdsInClass'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'uczen' => 'required',
            'przedmioty' => 'required',
            'ocena' => 'required',
        ]);

        // Save the grade data to the database using the Grade model
        Grade::create([
            'student_id' => $validatedData['uczen'],
            'subject_id' => $validatedData['przedmioty'],
            'grade' => $validatedData['ocena'],
        ]);

        // Redirect back or show a success message
        return redirect()->route('index')->with('success', 'Grade saved successfully!');
    }
}
