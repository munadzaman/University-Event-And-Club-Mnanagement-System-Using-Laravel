<?php

namespace App\Providers;

use App\Http\ViewComposers\NotificationComposer;
use Illuminate\Support\Facades\View;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
    public function boot()
    {
        // Attach the NotificationComposer to the views that require notifications
        View::composer('*', NotificationComposer::class);
    }
}
