<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiFeV1Routes();
        $this->mapApiV1Routes();
        $this->mapWebRoutes();
    }

    /**
     * Define the API routes for the application.
     *
     * @return void
     */
    public function mapApiV1Routes()
    {
        \Route::prefix('api/v1')
            ->middleware('api')
            ->namespace($this->namespace . '\Api\v1')
            ->group(base_path('routes/api-v1.php'));
    }

    public function mapApiFeV1Routes()
    {
        \Route::prefix('api/fe/v1')
            ->middleware('api')
            ->namespace($this->namespace . '\FE\v1')
            ->group(base_path('routes/apife-v1.php'));
    }

    public function mapWebRoutes()
    {
        \Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/backend.php'));
    }
}
