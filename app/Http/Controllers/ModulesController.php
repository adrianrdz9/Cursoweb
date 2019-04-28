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
        $this->middleware('can:create modules')->except('index');
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

        return redirect()->route('modules.index')->with('notice', 'Modulo creado');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
