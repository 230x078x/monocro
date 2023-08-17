<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Day;
use App\Models\Guest;
use App\Models\Job;
use App\Models\Menu;


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
    public function boot(): void
    {
        view()->composer('*', function ($view) 
        {
            
            //...with this variable
            $user = auth()->user();
            $jobs=Job::get();
            $menus=Menu::get();
            $view->with('day', Day::first())->with('user',$user)->with('menus',$menus)->with('jobs',$jobs);    
        });
    }
    
}

