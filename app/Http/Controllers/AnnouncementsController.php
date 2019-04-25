<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use \App\Announcement;
use \Carbon\Carbon;

class AnnouncementsController extends Controller
{

    public function __construct(){
    }

    public function index(){
        if(!auth()->user()->can('view all announcements') ){
            return redirect('/');
        }
        
        $announcements = Announcement::all();
        
        return view('announcements.index', ['announcements' => $announcements]);
    }
    
    public function create(){
        if(!auth()->user()->can('create announcements')){            
            return redirect('/');
        }

        return view('announcements.create', ['announcement' => new Announcement()]);
    }

    public function store(Request $request){
        if(!auth()->user()->can('create announcements')){            
            return redirect('/');
        }

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

    public function destroy(Announcement $announcement){
        if(!auth()->user()->can('delete announcements')){            
            return redirect('/');
        }

        $announcement->delete();
        return redirect()->route('announcements.index')->with('notice', 'Aviso eliminado');
    }
}

