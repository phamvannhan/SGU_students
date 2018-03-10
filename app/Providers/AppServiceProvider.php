<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        

        //chia se locale da ngon ngu 
        View::composer('*', function ($view){
            $view->with('composer_locale', \App::getLocale());
        });


        // Admin chia se login auth
        View::composer([
            'admin.layouts.partials.menu',
            'admin.dashboard.index',
        ], function ($view) {
            $arr = \Auth::user()->getPermissions()->pluck('slug')->toArray();
            $view->with('composer_auth_permissions', $arr);
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



}
