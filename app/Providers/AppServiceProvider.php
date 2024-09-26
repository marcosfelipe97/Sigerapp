<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       

        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\EquipamentosRepositoryInterface', 'App\Repositories\EquipamentosRepositoryEloquent');
        $this->app->bind('App\Repositories\Contracts\ReservasRepositoryInterface',         'App\Repositories\ReservasRepositoryEloquent');
        $this->app->bind('App\Repositories\Contracts\DevolucaoRepositoryInterface',       'App\Repositories\DevolucaoRepositoryEloquent');
    }
}
