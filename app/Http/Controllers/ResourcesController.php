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
        $this->middleware('can:view resources')->only(['index', 'show']);
        $this->middleware('can:create resources')->except(['index', 'show']);
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


        $resource = Resource::create([
            'title' => $request['title'],
            'type' => $request['type'],
            'description' => $request['description'],
            'link' => $request['link'],
        ]);

        return redirect()->route('resources.show', ['id' => $resource->id])->with('notice', 'Recurso actualizado');
    }

    public function show(Resource $resource){
        return view('resources.show', ['resource' => $resource]);
    }

    public function edit(Resource $resource){
        return view('resources.create', ['resource' => $resource]);
    }

    public function update(Request $request, Resource $resource){
        $request->validate([
            'title' => ['required', 'string'],
            'type' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'link' => ['nullable', 'string'],
            'attachment' => ['nullable', 'string'],
        ]);


        $resource->update([
            'title' => $request['title'],
            'type' => $request['type'],
            'description' => $request['description'],
            'link' => $request['link'],
        ]);

        return redirect()->route('resources.show', ['id' => $resource->id])->with('notice', 'Recurso actualizado');
    }

    public function destroy(Resource $resource){
        $resource->delete();

        return redirect()->route('resources.index');
    }


}
