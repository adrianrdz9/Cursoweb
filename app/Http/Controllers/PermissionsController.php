<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionsController extends Controller {

    public function __construct() {
        $this->middleware(['auth', 'role:admin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        $permissions = Permission::all(); //Get all permissions

        return view('permissions.index', compact('permissions'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        return view('permissions.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
        $request->validate([
            'name'=> ['required', 'max:40'],
        ]);

        $permission = Permission::create($request->only(['name']));

        return redirect()->route('permissions.index')
            ->with('notice',
             'Permiso '. $permission->name.' creado!');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
        return redirect('permissions');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Permission $permission) {
        return view('permissions.edit', compact('permission'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Permission $permission) {
        $request->validate([
            'name'=>'required|max:40',
        ]);
        
        $permission->update($request->only(['name']));

        return redirect()->route('permissions.index')
            ->with('notice',
             'Permiso '. $permission->name.' actualizado!');

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Permission $permission) {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('notice',
             'Permission deleted!');

    }
}