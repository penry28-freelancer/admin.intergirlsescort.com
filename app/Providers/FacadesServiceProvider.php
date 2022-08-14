<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class FacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('student', function() {
            return \App\Student\StudentFacade::class;
        });
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
