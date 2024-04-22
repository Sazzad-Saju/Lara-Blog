<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    
    public function store()
    {
        $attributes = request()->validate([
            // 'email' => 'required|exists:users,email'
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(auth()->attempt($attributes)){
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome Back!');
        }
        //auth failed
        // return back()
        //     ->withInput()
        //     ->withErrors(['email' => 'Your provided credential could not be verified!']);
        
        throw ValidationException::withMessages([
            'email' => 'Your provided credential could not be verified!'
        ]);
    }
    public function destroy()
    {
        auth()->logout();
        
        return redirect('/')->with('success', 'Successfully Logged out!');
    }
}
