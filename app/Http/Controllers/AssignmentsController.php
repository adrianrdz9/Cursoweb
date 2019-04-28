<?php

namespace App\Http\Controllers;

use Validator;
use Notification;
use App\Assignment;
use App\Module;
use App\User;
use App\Notifications\AssignmentCreated;


use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modules = Module::with('assignments')->get();
        return view('assignments.index', ['modules' => $modules]);
    }

    public function create(){
        $this->authorize('create', Assignment::class);

        return view('assignments.create', ['assignment' => new Assignment() ]);
    }

    public function store(Request $request){

        $this->authorize('create', Assignment::class);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:190'],
            'deadline' => ['required', 'date_format:Y-m-d H:i:s', 'after:today'],
            'description' => ['nullable', 'string'],
            'example' => ['nullable', 'string'],
            'type' => ['required', 'string'],
            'module_id' => ['required', 'exists:modules,id']
        ]);

        if( 
            !auth()->user()->teachModule($request['module_id'])
         ){
            return redirect()->route('assignment.create')->withInput($request->all())->with('notice', 'No puedes crear tareas para modulos en los que no eres profesor');
         }

        if($validator->fails()){
            return redirect()->route('assignment.create')->withInput($request->all())->withErrors($validator);
        }

        $assignment = Assignment::create($request->all());

        Notification::send(User::all(), new AssignmentCreated($assignment));

        return redirect()->route('assignment.show', [$assignment]);
    
    }

    public function show(Assignment $assignment){
        $this->authorize('view', $assignment);

        return view('assignments.show', ['assignment' => $assignment]);
    }
}
