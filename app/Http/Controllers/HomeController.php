<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
use Notification;
use App\Notifications\SendEmailNotification;

class HomeController extends Controller
{

    public function sendnotification($useremail){
        
        $user = User::where('email', $useremail)->first();

        if($useremail){

            $username = $user->name;

            $details = [
                'greeting' =>  $username.' is commented on your post',
                'actiontext' => 'hello',
                'actionurl' => '/',
            ];
    
            Notification::send($user, new SendEmailNotification($details));
            return back();
        }
        
        dd("done");
    }


    public function index(){
        if(Auth::id()){
            
            $usertype = Auth()->user()->usertype;

            if($usertype == 'user'){
                $posts = Post::all();
                $posts = Post::orderBy('created_at','DESC')->paginate(6);
                return view('allposts.index', compact('posts'));
            }

            else  if($usertype == 'admin'){
                $posts = Post::with('comments.user')->get();
                return view('admin.index', compact('posts'));
            }

            else{
                return redirect()->back();
            }
        }
    }
}
