<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        // Tworzymy nowe uprawnienie na podstawie danych z formularza.
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->save();

        // Możemy również dodać odpowiedni komunikat o sukcesie.
        return redirect()->route('roles.index')->with('success', 'Uprawnienie zostało dodane pomyślnie.');
    }
}
