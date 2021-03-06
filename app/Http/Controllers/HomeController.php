<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assignment;
use App\User;
use App\Module;
use App\Announcement;
use App\Post;

use Spatie\Permission\Models\Role;

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
        $this->middleware('can: view grades')->only('calificaciones');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole(Role::all())) {
            $now = date('Y-m-d');
            $announcements = Announcement::where(
                'expiration', '>=', $now
            )->orderByDesc('created_at')->get();
    
            $assignments = Assignment::orderByDesc('created_at')->limit(4)->get();
    
            $notifications['unread'] = auth()->user()->unreadNotifications;
            $notifications['read'] = auth()->user()->readNotifications;
    
            $posts = Post::orderByDesc('created_at')->limit(4)->get();
    
            return view('home',compact('assignments', 'notifications', 'announcements', 'posts'));
        }

        return view('guest');

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

    public function calificaciones(){
        $modules = Module::with('assignments')->get();

        $users = User::with('deliveries')->get();

        

        return view('deliveries.calificaciones', compact('modules', 'users'));
    }
}
