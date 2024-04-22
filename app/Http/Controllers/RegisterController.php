<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        // $user = User::first();
        // return $user;
        return view('register.create');
    }
    
    public function store()
    {
        // var_dump(request()->all());
        // return request()->all();
        
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'user_name' => 'required|min:3|max:255|unique:users,user_name',
            // 'user_name' => ['required', 'min:3', 'max:255', Rule::unique('users', 'user_name')],
            // 'user_name' => ['required', 'min:3', 'max:255', Rule::unique('users', 'user_name')->ignore(47)],
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            // 'password' => ['required', 'min:6', 'max:255'],
        ]);
        
        // dd('validation success');
        
        // $attributes['password'] = bcrypt($attributes['password']);
        
        $user = User::create($attributes);
        
        // session()->flash('success', 'Your account has been created!');
        
        // return redirect('/');
        
        auth()->login($user);
        
        return redirect('/')->with('success', 'Your account has been created!');
    }
}
