<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Classes;
use App\Models\Student;

use Illuminate\Http\RedirectResponse;
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

        return redirect()->route('index')
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

        return redirect()->route('index')
            ->with('success', 'Dane klasy zaktualizowane.');
    }
    public function destroy($id): RedirectResponse
    {
        $class = Classes::find($id);

        if (!$class) {
            return redirect()->route('index')
                ->with('error', 'Class not found.');
        }

        $class->delete();

        return redirect()->route('index1')
            ->with('success', 'Klasa usunięta prawidłowo.');
    }

    public function show(Classes $class)
    {
        $key = 0;
        $students = $class->students;
        $className = $class->nazwa;
        $allStudents = Student::whereDoesntHave('classes')->get();

        return view('classes.show', compact('class', 'students','className','allStudents','key'));
    }


    public function addStudent(Request $request, Classes $class)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $studentId = $request->input('student_id');
        $student = Student::find($studentId);

        // Sprawdź, czy uczeń już nie jest przypisany do innej klasy
        $existingClass = $student->classes->first(); //pobieram z relacji classes modelu student pierwszy element ktory jest przypisany do ucznia
        if ($existingClass && $existingClass->id !== $class->id) {
            return redirect()->route('classes.show', $class->id)->with('error', 'Ten uczeń jest już przypisany do innej klasy.');
        }

        // Przypisz ucznia do klasy (z unikalnością)
        $class->students()->syncWithoutDetaching([$studentId]);

        return redirect()->route('classes.show', $class->id)->with('success', 'Uczeń został dodany do klasy.');
    }


}
