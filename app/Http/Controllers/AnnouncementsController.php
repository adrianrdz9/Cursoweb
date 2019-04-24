<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Announcement;
use \Carbon\Carbon;

class AnnouncementsController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except([]);
    }

    public function index(){
        $announcements = Announcement::all();


        return view('announcements.index', ['announcements' => $announcements]);
    }

    public function create(){
        return view('announcements.create', ['announcement' => new Announcement()]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'expiration' => ['required', 'date']
        ]);

        Announcement::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'expiration' => $request['expiration'],
        ]);

        return redirect()->route('announcements.index');
    }
}

