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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https'); // This forces HTTPS scheme for URLs
        }
        new kaban;
        new Skpd;
        new superadmin;
    }
}
