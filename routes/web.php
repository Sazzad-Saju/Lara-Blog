<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);

// Route::get('ping', function(){
// Route::post('newsletter', function(){
// Route::post('newsletter', function(Newsletter $newsletter){
//     // request()->validate(['email' => 'required|email']);
    
//     // $mailchimp = new \MailchimpMarketing\ApiClient();

//     // $mailchimp->setConfig([
//     //     'apiKey' => config('services.mailchimp.key'),
//     //     'server' => 'us18'
//     // ]);
//     // // $response = $mailchimp->ping->get();
//     // // $response = $mailchimp->lists->getAllLists();
//     // // $response = $mailchimp->lists->getList('9da31f5c2d');
//     // // $response = $mailchimp->lists->getListMembersInfo('9da31f5c2d');
//     // try{
//     //     $response = $mailchimp->lists->addListMember('9da31f5c2d',[
//     //         // 'email_address' => 'test@example.com', 
//     //         'email_address' => request('email'), 
//     //         'status' => 'subscribed'
//     //     ]);
//     // } catch (\Exception $e){
//     //     throw \Illuminate\Validation\ValidationException::withMessages([
//     //         'email' => 'This email can not be added to our newsletter list.'
//     //     ]);
//     // }
//     // // ddd($response);
//     // return redirect('/')->with('success', 'You are now signed up for our newsletter!');
    
//     request()->validate(['email' => 'required|email']);
//     try{
//         // $newsletter = new Newsletter();  
//         // $newsletter->subscribe(request('email'));
//         // (new Newsletter())->subscribe(request('email'));
//         $newsletter->subscribe(request('email'));
//     } catch(\Exception $e){
//         throw ValidationException::withMessages([
//             'email' => $errorTitle = json_decode($e->getResponse()->getBody()->getContents(), true)['title'] ?? 'An error occurred'
//             // 'email' => 'This email can not be added to our newsletter list.'
//         ]);
//     }
    
//     return redirect('/')->with('success', 'You are now signed up for our newsletter!');
    
// });