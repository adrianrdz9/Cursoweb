<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentsController extends Controller
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

    public function show($id){
        return Comment::where([
            ['assignment_id', $id],
            ['comment_id', null]
        ])->with('comments.user')->with('user')->get();
    }

    public function store(Request $request){
        $this->authorize('create', Comment::class);

        $request->validate([
            'comment' => ['required'],
            'comment_id' => ['nullable', 'exists:comments,id'],
            'assignment_id' => ['required', 'exists:assignments,id'],
        ]);

        $comment = Comment::create(
            array_merge(
                $request->all(),
                ['user_id' => auth()->user()->id ]
            )
        );

        return redirect()->back();
    }
}
