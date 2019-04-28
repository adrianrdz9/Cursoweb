<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assignment;
use App\Announcement;
use App\Post;

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
        $now = date('Y-m-d');
        $announcements = Announcement::where(
            'expiration', '>=', $now
        )->get();

        $assignments = Assignment::orderByDesc('created_at')->limit(4)->get();

        $notifications['unread'] = auth()->user()->unreadNotifications;
        $notifications['read'] = auth()->user()->readNotifications;

        $posts = Post::orderByDesc('created_at')->limit(4)->get();

        return view('home',compact('assignments', 'notifications', 'announcements', 'posts'));
    }

    public function calendar(){
        $assignments = [];
        foreach(Assignment::all() as $a){
            if(!$a->delivered()){
                array_push($assignments, $a);
            }
        }
        $assignments = json_encode($assignments);
        //l jS \\of F Y h:i:s A
        Carbon::setLocale("es");
        setlocale(LC_ALL, 'es_ES');
        $today = Carbon::now()->formatLocalized("%A %e de %B, %Y");

        return view('calendar', ['assignments' => $assignments, 'today' => $today]);
    }
}
