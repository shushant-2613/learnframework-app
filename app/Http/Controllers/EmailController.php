<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailController extends Controller
{

    public function sendEmail(Request $request, $id)
    {
        $user = User::find($id);
        $email = $user->email;

        //$userEmail = 'example@example.com'; // Replace with the recipient's email address

    Mail::raw('Hello! This is a simple text email.', function ($message) use ($email) {
    $message->to($email)
            ->subject('Subject of the Email');
        });

        // Mail::to($email)->send("Hello");
        // return response()->json(['success' => true]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        //
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
