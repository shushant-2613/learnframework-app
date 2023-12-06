<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        $post = Post::orderBy('created_at', 'DESC')->paginate();
        return view('posts.index', compact('post'));
        // return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'postcontent' => 'required|max:250',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file types and size as needed
        ]);

        $postInput = new Post;
        $postInput->postcontent = $request->postcontent;

        //Below code is to get the current logged in user id from the database.
        $postInput->user_id = Auth::User()->id;

        //Below code is to handle the exception, which may occur during the image upload.
        $imagePath = null;

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images/posts', 'public');
        }
        else{
            $imagePath = null;
        }

        $postInput->image = $imagePath;  
        $postInput->save();
        return redirect('/posts');
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
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'postcontent' => 'required|max:250',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file types and size as needed
        ]);

        $post = Post::findOrFail($id);

        $imagePath = null;

        if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('images/posts', 'public');
            }
        else{
            $imagePath = null;
        }
        //dd($imagePath);
        $post->update([
            'postcontent' => $request->input('postcontent'),
            'image' => $imagePath,
        ]);
        
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
