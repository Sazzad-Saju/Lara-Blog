<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'user_name' => 'required|min:3|max:255|unique:users,user_name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ]);
        
        $user = User::create($attributes);
        
        auth()->login($user);
        
        return redirect('/')->with('success', 'Your account has been created!');
    }
}
