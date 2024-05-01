<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);
        try{
            $newsletter->subscribe(request('email'));
        } catch(\Exception $e){
            throw ValidationException::withMessages([
                'email' => $errorTitle = json_decode($e->getResponse()->getBody()->getContents(), true)['title'] ?? 'An error occurred'
            ]);
        }
        
        return redirect('/')->with('success', 'You are now signed up for our newsletter!');
    }
}
