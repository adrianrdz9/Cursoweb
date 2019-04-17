<?php

namespace App\Http\Controllers;

use Validator;
use App\Assignment;

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
        $this->middleware('admin')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $assignments = Assignment::all()->sortBy('deadline')->groupBy('type');
        return view('assignments.index', ['assignments' => $assignments]);
    }

    public function create(){
        return view('assignments.create', ['assignment' => new Assignment() ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:190'],
            'deadline' => ['required', 'date_format:Y-m-d H:i:s', 'after:today'],
            'description' => ['nullable', 'string'],
            'example' => ['nullable', 'string'],
            'type' => ['required', 'string']
        ]);

        if($validator->fails()){
            return redirect()->route('assignment.create')->withInput($request->all())->withErrors($validator);
        }

        $assignment = Assignment::create($request->all());

        return redirect()->route('assignment.show', [$assignment]);
    
    }

    public function show(Assignment $assignment){
        return view('assignments.show', ['assignment' => $assignment]);
    }
}
