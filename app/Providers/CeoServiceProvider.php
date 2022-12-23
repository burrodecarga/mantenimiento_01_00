<?php

namespace App\Providers;

use App\Interfaces\CeoServiceInterface;
use App\Services\CeoService;
use Illuminate\Support\ServiceProvider;

class CeoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CeoServiceInterface::class, CeoService::class); //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
