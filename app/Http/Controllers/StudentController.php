<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
/*
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
*/
    public function index(): View
    {
        $students = Student::all();
        return view('students.index',compact('students'));

    }


    public function create(): View
    {
        return view('students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'imie' => 'required',
            'nazwisko' => 'required',
            'numer_indeksu' => 'required',
            'miejsce_zamieszkania' => 'required',
            'numer_telefonu' => 'required',
        ]);

        Student::create($validatedData);

        return redirect()->route('index')
            ->with('success', 'Udało się dodać studenta.');
    }





    public function edit(Student $student): View
    {
        return view('students.edit',compact('student'));
    }


    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'imie' => 'required',
            'nazwisko' => 'required',
            'numer_indeksu' => 'required',
            'miejsce_zamieszkania' => 'required',
            'numer_telefonu' => 'required',
        ]);

        $student->update($validatedData);

        return redirect()->route('index')
            ->with('success', 'Dane studenta zaktualizowane.');
    }


    public function destroy($id): RedirectResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return redirect()->route('index')
                ->with('error', 'Student not found.');
        }

        $student->delete();

        return redirect()->route('index')
            ->with('success', 'Student usunięty prawidłowo.');
    }

    public function show($id): View
    {
        $studentShow = Student::find($id);

        return view('students.show', compact('studentShow'));
    }

    public function newStudents(): View
    {
        //wyświetl studentów którzy nie maja żadnej przypisanej klasy czyli są traktowani jako nowi
        $students = Student::whereDoesntHave('classes')->get();

        return view('students.newStudents', compact('students'));


    }
}
