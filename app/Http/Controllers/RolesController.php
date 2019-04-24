<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class RolesController extends Controller
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
        $roles = Role::all();//Get all roles

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();//Get all permissions

        return view('roles.create', ['permissions'=>$permissions]);
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
            'name' => ['required', 'max:40'],
            'permissions' => ['required']
        ]);

        $role = Role::create($request->only(['name']));

        foreach ($request['permissions'] as $permission) {
            $permission_i = Permission::findOrFail($permission);

            $role->givePermissionTo($permission_i);
        }

        return redirect()->route('roles.index')
            ->with('notice',
             'Rol '. $role->name.' creado!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'max:40'],
            'permissions' => ['required']
        ]);

        $role->update($request->only(['name']));
        $role->syncPermissions([]);

        foreach ($request['permissions'] as $permission) {
            $permission_i = Permission::findOrFail($permission);

            $role->givePermissionTo($permission_i);
        }

        return redirect()->route('roles.index')
            ->with('notice',
             'Rol '. $role->name.' actualizado!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->name == 'admin'){
            return redirect()->route('roles.index')
            ->with('notice',
             'No se puede eliminar el rol de administrador'); 
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('notice',
             'Rol eliminado!');

    }
}
