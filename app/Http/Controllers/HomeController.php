<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assignment;
use App\Announcement;
use \Carbon\Carbon;

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
        $announcements = Announcement::where([
            'expiration', '<=', new Carbon()
        ]);

        return view('home', ['announcements' => $announcements]);
    }

    public function calendar(){
        $assignments = Assignment::all();
        //l jS \\of F Y h:i:s A
        Carbon::setLocale("es");
        setlocale(LC_ALL, 'es_ES');
        $today = Carbon::now()->formatLocalized("%A %e de %B, %Y");

        return view('calendar', ['assignments' => $assignments, 'today' => $today]);
    }
}
