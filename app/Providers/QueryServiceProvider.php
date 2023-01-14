<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class QueryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application service.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('withWhereHas', function ($relation, $constraint) {
            return $this->whereHas($relation, $constraint)
                ->with([$relation => $constraint]);
        });
    }
}
