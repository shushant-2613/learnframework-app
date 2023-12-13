<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($postid)
    {
        $post = Post::findOrFail($postid);
        return view('comments.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        // $request->validate([
        //     'commentcontent' => 'required',
        // ]);

        $comment = new Comment([
            'commentcontent' => $request->input('commentcontent'),
        ]);

        $comment->user_id = Auth::id();

        $post->comments()->save($comment);

        $userType = Auth::User()->usertype;

        if($userType == 'admin'){
           return redirect()->route('admin.index'); 
        }
        else{
           return redirect()->route('posts.index');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
