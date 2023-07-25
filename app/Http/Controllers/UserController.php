<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);

        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
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

        $roleToClassMap = [
            'Wychowawca1a' => '1a',
            'Wychowawca1b' => '1b',
            'Wychowawca1c' => '1c',

        ];
        // Przypisanie użytkownika do wydziału na podstawie ról
        $selectedRoles = $request->input('roles', []);
        foreach ($selectedRoles as $roleName) {
            if (isset($roleToClassMap[$roleName])) {
                $ClassName = $roleToClassMap[$roleName];
                $class = Classes::where('nazwa', $ClassName)->first();
                if ($class) {
                    $user->classes()->attach($class);
                }
            }
        }



        return redirect()->route('users.index')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $roleToClassMap = [
            'Wychowawca1a' => '1a',
            'Wychowawca1b' => '1b',
            'Wychowawca1c' => '1c',

        ];
        return view('users.edit',compact('user','roles','userRole','roleToClassMap'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */

    //poprawic funkcje update na podstawie funkcji z tamtego projektu
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required|array',
        ]);

        $input = $request->all();


        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->roles()->detach();
        // Usuń wszystkie rekordy z tabeli user_classes dla tego użytkownika
        $user->classes()->delete();

        // Zaktualizuj dane użytkownika
        $user->update($input);
        // Wyświetl aktualne przypisane klasy przed aktualizacją
        dump($user->classes->pluck('nazwa')->toArray());
        // Dodaj użytkownika do nowych klas na podstawie przesłanych ról
        $newRoles = $request->input('roles', []);
        foreach ($newRoles as $role) {
            $user->assignRole($role);

            // Pobierz klasę na podstawie nazwy roli i przypisz użytkownika do tej klasy
            $class = Classes::where('nazwa', $role)->first();
            if ($class) {
                // Użyj tabeli pośredniej user_classes do przypisania użytkownika do klasy
                $user->classes()->attach($class->id);
            }
        }
    // Wyświetl przypisane klasy po aktualizacji
        dump($user->classes->pluck('nazwa')->toArray());
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
