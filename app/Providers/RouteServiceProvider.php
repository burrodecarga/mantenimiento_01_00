<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web','auth','role:admin|super-admin')
                ->prefix('admin')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            Route::middleware('web','auth','role:planner|super-admin')
                ->prefix('planner')
                ->namespace($this->namespace)
                ->group(base_path('routes/planner.php'));

            Route::middleware('web','auth','role:storer|super-admin')
                ->prefix('storer')
                ->namespace($this->namespace)
                ->group(base_path('routes/storer.php'));

                Route::middleware('web','auth','role:rrhh|super-admin')
                ->prefix('rrhh')
                ->namespace($this->namespace)
                ->group(base_path('routes/rrhh.php'));

                Route::middleware('web','auth','role_or_permission:supervisor|super-admin|tecnico|jefe')
                ->prefix('mant')
                ->namespace($this->namespace)
                ->group(base_path('routes/mant.php'));

Route::middleware('web', 'auth', 'role_or_permission:ceo|super-admin')
    ->prefix('ceo')
    ->namespace($this->namespace)
    ->group(base_path('routes/ceo.php'));





        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
