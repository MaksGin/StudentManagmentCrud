<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Classes;
use App\Models\Student;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class ClassController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $classes = Classes::all();

        return view('classes.index',compact('classes'));
    }



    public function create(): View
    {
        return view('classes.create');
    }

    public function store(\Illuminate\Http\Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nazwa' => 'required',
            'rok_szkolny' => 'required',
            'profil' => 'required',
            'wychowawca' => 'required',
            'liczba_uczniow' => 'required',
            'godziny_lekcyjne' => 'required',
        ]);

        Classes::create($validatedData);

        return redirect()->route('index1')
            ->with('success', 'Udało się dodać klase.');
    }

    public function edit(Classes $class): View
    {
        return view('classes.edit', ['class' => $class]);
    }

    public function update(\Illuminate\Http\Request $request,Classes $class)
    {
        $validatedData = $request->validate([
            'nazwa' => 'required',
            'rok_szkolny' => 'required',
            'profil' => 'required',
            'wychowawca' => 'required',
            'liczba_uczniow' => 'required',
            'godziny_lekcyjne' => 'required',
        ]);

        $class->update($validatedData);

        return redirect()->route('index1')
            ->with('success', 'Dane klasy zaktualizowane.');
    }
    public function destroy($id)
    {
        $class = Classes::find($id);

        if (!$class) {
            return redirect()->route('index1')->with('error', 'Class not found.');
        }else{
            $class->delete();

            return redirect()->route('index1')->with('success', 'Klasa usunięta prawidłowo.');

        }

    }


    public function show(Classes $class)
    {

        $students = $class->students;
        $className = $class->nazwa;
        $allStudents = Student::whereDoesntHave('classes')->get();

        return view('classes.show', compact('class', 'students','className','allStudents'));
    }

    public function deleteStudentFromClass($id): RedirectResponse
    {
        $studentToDelete = Student::find($id);
        $studentToDelete->classes()->detach();

        return redirect()->back()->with('success', 'Student usunięty z klasy.');
    }

    public function addStudent(Request $request, Classes $class)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $studentId = $request->input('student_id');
        $student = Student::find($studentId);


        $existingClass = $student->classes->first();
        if ($existingClass && $existingClass->id !== $class->id) {
            return redirect()->route('classes.show', $class->id)->with('error', 'Ten uczeń jest już przypisany do innej klasy.');
        }

        // czy klasa nie jest pełna
        if ($class->students->count() >= $class->liczba_uczniow) {
            return redirect()->route('classes.show', $class->id)->with('error', 'Klasa jest pełna. Nie można dodać więcej uczniów.');
        }

        // Przypisz ucznia do klasy (z unikalnością)
        $class->students()->syncWithoutDetaching([$studentId]);

        return redirect()->route('classes.show', $class->id)->with('success', 'Uczeń został dodany do klasy.');
    }


    public function showClass(): View
    {
        $wychowawca = Auth::user();

        // Sprawdzamy, czy zalogowany użytkownik ma rolę "Wychowawca1c"
        if ($wychowawca->hasRole(['Wychowawca1a', 'Wychowawca1b', 'Wychowawca1c', 'Wychowawca1d','Wychowawca2a'])) {
            // Pobieramy klasy przypisane do określonego wychowawcy
            $classes = Classes::whereHas('users', function ($query) use ($wychowawca) {
                $query->where('user_id', $wychowawca->id);
            })->get();

            return view('classes.showClass', compact('classes','wychowawca'));
        } else {

            abort(403, 'Brak dostępu.');
        }

    }


}
