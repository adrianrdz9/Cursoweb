<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;
use Session;
use App\User;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author')->orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        if(!auth()->user()->can('create posts')){
            return redirect()->route('posts.index')->with(['notice' => 'No puedes crear publicaciones']);
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Auth $user)
    {
        $this->authorize('create', Post::class);

        $request->validate([
            'title' => ['required', 'max:100'],
            'body' => ['required']
        ]);

        Post::create(
            array_merge(
                $request->only(['title', 'body']),
                ['author_id' => auth()->user()->id]
            )
        );

        return redirect()->route('posts.index')
            ->with('notice', 'Publicación creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Auth $user)
    {
        $this->authorize('view', $post);

        return view ('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Auth $user)
    {
        $this->authorize('update', $post);

        return view ('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Auth $user)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => ['required', 'max:100'],
            'body' => ['required']
        ]);

        $post->update($request->only(['title', 'body']));

        return redirect()->route('posts.show', 
            $post->id)->with('notice', 
            'Publicación actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Auth $user)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')
        ->with('notice',
         'Publicación eliminada');
    }
}
