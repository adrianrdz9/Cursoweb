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
}
