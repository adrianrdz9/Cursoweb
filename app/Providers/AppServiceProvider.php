<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

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
        Schema::defaultStringLength(191);

        Blade::if('admin', function () {

            if(auth()->check()){
                return auth()->user()->account_number == '317114270';
            }

            return false;
        });

        Blade::if('student', function () {
            return true;
            if(auth()->check()){
                if(auth()->user()->account_number == '317114270'){
                    return false;
                }

                return auth()->user()->accepted;
            }

            return false;
        });
    }
}
