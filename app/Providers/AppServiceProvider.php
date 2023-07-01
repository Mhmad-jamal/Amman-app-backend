<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Helpers\Permission;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $permission = new Permission();
            $view->with('permission', $permission);
        });
    }
}
