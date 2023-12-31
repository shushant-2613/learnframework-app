<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        // $posts = Post::with('comments.user')->get();
        // return view('admin.index', compact('posts'));

        $posts = Post::with('comments.user')->get();
        return view('admin.index', compact('posts'));
    }
}
