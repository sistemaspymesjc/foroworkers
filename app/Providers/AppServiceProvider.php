<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;

// use App\Contracts\MyInterface;
// use App\Services\MyConcreteService;

// use App\Tutorial\TutorialInterface;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(
        //     TutorialInterface::class           
        // );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Paginator::useBootstrap();
    }
}
