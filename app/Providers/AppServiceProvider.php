<?php

namespace App\Providers;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;
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
        \Carbon\Carbon::setLocale(config('app.locale'));

        \Faker\Factory::create('es_ES');

        Schema::defaultStringLength(191);
        \Laravel\Passport\Passport::withoutCookieSerialization();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
