<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Resource;

class ResourcesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $resources = Resource::all();

        return view('resources.index', ['resources' => $resources]);
    }

    public function create(){
        $resource = new Resource();

        return view('resources.create', ['resource' => $resource]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'string'],
            'type' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'string'],
            'attachment' => ['nullable', 'string'],
        ]);

        // TO DO - Validar y mover el archivo adjunto (si existe) y guardar su ubicación

        $resource = Resource::create([
            'title' => $request['title'],
            'type' => $request['type'],
            'description' => $request['description'],
            'link' => $request['link'],
        ]);

        return redirect()->route('resources.show', ['id' => $resource->id]);
    }

    public function show(Resource $resource){
        return view('resources.show', ['resource' => $resource]);
    }


}
