<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Menu\kaban;
use App\Menu\Skpd;
use App\Menu\superadmin;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        new kaban;
        new Skpd;
        new superadmin;
    }
}
