<?php

namespace App\Providers;

use App\Interfaces\DatosServiceInterface;
use App\Services\DatosService;
use Illuminate\Support\ServiceProvider;

class DatosServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DatosServiceInterface::class, DatosService::class); //
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
