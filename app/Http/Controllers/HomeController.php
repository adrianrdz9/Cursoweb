<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assignment;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function calendar(){
        $assignments = Assignment::all();

        return view('calendar', ['assignments' => $assignments]);
    }
}
