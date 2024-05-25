<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // app()->bind('foo', function (){
        //     return 'bar';
        // });
        
        // app()->bind(Newsletter::class, function(){
        //     return new Newsletter(
        //         new ApiClient(),
        //         'foobar'
        //     );
        // });
        
        // app()->bind(Newsletter::class, function(){
        // app()->bind(MailchimpNewsletter::class, function(){
        app()->bind(Newsletter::class, function(){
            
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);
            
            // return new Newsletter($client);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
        Model::unguard();
        
        Gate::define('admin', function (User $user){
            // auth()->user()?->user_name !== 'SuperAdmin';
            return $user->user_name == 'SuperAdmin';
        });
        
        Blade::if('admin', function() {
            return request()->user()?->can('admin');
        });
    }
}
