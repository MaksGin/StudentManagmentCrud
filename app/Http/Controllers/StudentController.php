<?php

namespace App\Http\Controllers;


use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
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


    public function update(Request $request, Student $student): RedirectResponse
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

        return redirect()->route('student.index')
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

    public function gradeList(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $loggedInUser = auth()->user();
        $idStudentazalogowanego = $loggedInUser->students()->first()->id;


        $oceny = Grade::where('student_id', $idStudentazalogowanego)->with('subject')->get();

        return view('students.StudentView.grades', compact('oceny'));
    }


    public function showProfile($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $loggedInUser = auth()->user();
        $studentShow = User::find($id);
        $student = $loggedInUser->students->first();
        return view('students.StudentView.profile', compact('studentShow','student'));
    }

    public function studentManage(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $students = Student::all();
        $users = User::all();

        $roles = Role::where('name', 'Uczen')->pluck('name', 'name')->all();
        return view('students.manage',compact('students','users','roles'));
    }

    public function assignStudent(Request $request): RedirectResponse
    {
        $studentId = $request->input('student_id');
        $userId = $request->input('user_id');

        $student = Student::find($studentId);
        $user = User::find($userId);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required|array',
        ]);



        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        // Przypisanie ról do użytkownika
        $user->assignRole($request->input('roles'));

        if($student && $user){
            $student->user()->attach($user);
            return redirect()->route('Students.manage')->with('success', 'Przypisanie wykonane pomyślnie.');
        }else{
            return redirect()->back()->with('error', 'Nie można przypisać studenta do użytkownika.');
        }
    }
}
