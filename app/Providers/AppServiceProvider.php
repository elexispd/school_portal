<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AdmissionNumberService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AdmissionNumberService::class, function () {
            return new AdmissionNumberService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
