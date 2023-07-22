<?php

namespace App\Providers;

use App\Services\DataProviderXService;
use App\Services\DataProviderYService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DataProviderXService::class);
        $this->app->singleton(DataProviderYService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
