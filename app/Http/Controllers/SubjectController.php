<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subjectList(){

        $subjects = Subject::all();
        $teachers = User::whereHas('classes')->get();
        return view('subjects.index',compact('subjects','teachers'));
    }

    public function assignSubject(Request $request): RedirectResponse
    {
        $subjectId = $request->input('przedmioty');
        $teacherId = $request->input('nauczyciele');

        // Tutaj możesz wykonać logikę przypisywania przedmiotu do nauczyciela
        $subject = Subject::find($subjectId);
        $teacher = User::find($teacherId);
        $subject->users()->attach($teacher);

        return redirect()->route('subjectList')->with('success', 'Przypisanie wykonane pomyślnie.');
    }
}
