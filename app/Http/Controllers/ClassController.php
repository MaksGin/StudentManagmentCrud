<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use http\Env\Request;
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

        return redirect()->route('index')
            ->with('success', 'Klasa usunięta prawidłowo.');
    }

}
