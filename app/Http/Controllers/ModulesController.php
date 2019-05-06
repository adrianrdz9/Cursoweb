<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Module;
use App\ModuleTeacher;
use App\User;

class ModulesController extends Controller
{

    function __construct(){
        $this->middleware('can:view modules')->only('index');
        $this->middleware('can:manage modules')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();

        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if($request->ajax()){
            return User::all();
        }

        return view('modules.create');
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
            'name' => ['required', 'max:100'],
            'description' => ['required'],
            'hours' => ['required'],
            'evaluation' => ['required'],
            'teachers' => ['required']
        ]);

        $module = Module::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'hours' => $request['hours'],
            'evaluation' => $request['evaluation']
        ]);

        foreach ($request['teachers'] as $teacher_id) {
            ModuleTeacher::create([
                'teacher_id' => $teacher_id,
                'module_id' => $module->id
            ]);
        }

        return redirect()->route('modules.index')->with('notice', 'Módulo creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::find($id);

        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'description' => ['required'],
            'hours' => ['required'],
            'evaluation' => ['required'],
            'teachers' => ['required']
        ]);

        $module->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'hours' => $request['hours'],
            'evaluation' => $request['evaluation']
        ]);

        ModuleTeacher::where('module_id', $module->id)->delete();

        foreach ($request['teachers'] as $teacher_id) {
            ModuleTeacher::create([
                'teacher_id' => $teacher_id,
                'module_id' => $module->id
            ]);
        }

        return redirect()->route('modules.show', ['id' => $module->id])->with('notice', 'Módulo actualizado');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return  redirect()->route('modules.index')->with('notice', 'Módulo eliminado');
    }
}
