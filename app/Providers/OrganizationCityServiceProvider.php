<?php

namespace App\Providers;

use App\Domain\Repositories\OrganizationCity\OrganizationCityRepositoryEloquent;
use App\Domain\Repositories\OrganizationCity\OrganizationCityRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class OrganizationCityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            OrganizationCityRepositoryInterface::class,
            OrganizationCityRepositoryEloquent::class
        );
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
