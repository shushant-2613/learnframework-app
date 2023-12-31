<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Auth;
use Notification;
use App\Notifications\SendEmailNotification;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // $comments = Comment::findOrFail($id);
        
        // return view('comments.index', compact('comments'));

        $post = Post::findOrFail($id);
        $comments = $post->comments; // Retrieve all comments for the post

        return view('comments.index', compact('comments', 'post'));
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
    public function store(Request $request)
    {
        // $post = Post::findOrFail($postId);
        
        // $comment = new Comment([
        //     'commentcontent' => $request->input('commentcontent'),
        // ]);

        // $comment->user_id = Auth::id();

        // $post->comments()->save($comment);

        $validateData = $request->validate([
            'commentcontent' => 'required|max:191',
            'post_id' => 'required|max:191',
            'user_id' => 'required|max:191',
        ]);

        if (!$validateData) {
            return response()->json([
                'status' => 400,
                'errors' => "Something went wrong",
            ]);
        } else {
    
            $comment = new Comment;
            $comment->commentcontent = $request->input('commentcontent');
            $comment->post_id = $request->input('post_id');
            $comment->user_id = $request->input('user_id');
            $comment->save();
    
            return response()->json([
                'status' => 200,
                'message' => 'Comment added successfully',
                'user' => $comment->user,
                'commentcontent' => $comment->commentcontent,
            ]);
        }

        // $userType = Auth::User()->usertype;

        // if($userType == 'admin'){
        //    return redirect()->route('admin.index'); 
        // }
        // else{
            
        //     $a = $post->user->email;
        //     //return redirect('/send/'.$a);
        //     redirect()->route('posts.index'); 
        // }

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
