<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assignment;
use App\Delivery;

class DeliveriesController extends Controller
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
        if(auth()->user()->hasRole('admin')){
            $deliveries = Assignment::with('deliveries.user')->get();
        }else if(auth()->user()->can('view delieries')){
            $deliveries = Delivery::where([
                ['user_id', auth()->user()->id]
            ])->with('assignment')->get()->sortByDesc('updated_at');
        }else{
            $deliveries = [];
        }

        return view('deliveries.index', ['deliveries' => $deliveries]);
    }

    public function show($id){
        $assignment = Assignment::find($id);
        return view('deliveries.show', ['assignment' => $assignment]);
    }

    public function store(Request $request){
        $this->authorize('create', Delivery::class);

        $request->validate([
            'assignment_id' => ['required', 'exists:assignments,id'],
            'link' => ['required'],
            'comment' => ['nullable']
        ]);

        $delivery = Delivery::create([
            'link' => $request['link'],
            'comment' => $request['comment'],
            'assignment_id' => $request['assignment_id'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('delivery.show', ['assignment_id' => $delivery->assignment_id]);
    }

    public function update(Delivery $delivery, Request $request){

        $this->authorize('update', $delivery);

        $request->validate([
            'link' => ['required'],
            'comment' => ['nullable']
        ]);

        $delivery->update([
            'link' => $request['link'],
            'comment' => $request['comment']
        ]);

        return redirect()->route('delivery.show', ['assignment_id' => Delivery::find($id)->assignment_id]);
    }
}
