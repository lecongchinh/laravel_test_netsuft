<?php

namespace App\Providers;

use App\Repositories\Staffs\StaffRepository;
use App\Repositories\Staffs\StaffRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            StaffRepositoryInterface::class,
            StaffRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
