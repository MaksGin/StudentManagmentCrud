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
            'uczen_id' => 'required',
            'przedmioty' => 'required',
        ]);

        $ocena = $request->input('ocena');


        Grade::create([
            'student_id' => $validatedData['uczen_id'],
            'subject_id' => $validatedData['przedmioty'],
            'grade' => $ocena,
        ]);

        // You may also add some success message or redirect back to the form
        return redirect()->route('teachers.studentMark')->with('success', 'Udało się dodać ocenę.');
    }
}
