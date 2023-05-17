<?php

namespace App\Providers;

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
    public function boot(): void
    {
        //
    }
}


/*
        view()->composer('layouts/app', function ($view) {
            $categorieServices = CategorieService::all();
            $technologies = Technologie::take(3)->get();
            $user = User::findOrFail(1);
            //dd($categorieServices);
            $view->with([
                'categorieServices' => $categorieServices,
                'technologies' => $technologies,
                'user' => $user
            ]);
        });
        view()->composer('layouts/app2', function ($view) {
            $categorieServices = CategorieService::all();
            $technologies = Technologie::take(3)->get();
            $user = User::findOrFail(1);
            //dd($categorieServices);
            $view->with([
                'categorieServices' => $categorieServices,
                'technologies' => $technologies,
                'user' => $user
            ]);
        });
*/  