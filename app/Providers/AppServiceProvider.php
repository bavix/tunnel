<?php

namespace App\Providers;

use App\Services\IpService;
use App\Services\TunnelService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->singleton(TunnelService::class);
        $this->app->singleton(IpService::class);
    }
}
