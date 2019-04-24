<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;


class UsersController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all(); 
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'account_number' => ['nullable', 'max:9'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        $user = User::create(
            array_merge(
                $request->only(['name', 'email', 'account_number']),
                ['password' => Hash::make($request['password'])]
            )
        );

        if(isset($request['roles'])){
            foreach ($request['roles'] as $role) {
                $role_i = Role::where('id', $role)->firstOrFail();
                $user->assignRole($role);
            }
        }

        return redirect()->route('users.index')
        ->with('notice',
         'Usuario creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all(); 

        return view('users.edit', compact('user', 'roles')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required','max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'account_number' => ['nullable', 'max:9'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        $user->update(array_merge(
            $request->only(['name', 'account_number', 'email']),
            Hash::make($request['password'])
        ));

        if (isset($request['roles'])) { 
            $user->roles()->detach(); 
            foreach ($request['roles'] as $role) {
                $role_i = Role::where('id', $role)->firstOrFail();
                $user->assignRole($role);
            }        
        }        
        else {
            $user->roles()->detach(); 
        }

        return redirect()->route('users.index')
        ->with('notice',
         'Usuario actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }
}
