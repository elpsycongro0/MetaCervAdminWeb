<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->register();

        \Gate::define('super-admin', function ($user) {
            if ($user->id_privilege == 4) {
                return true;
            }
            return false;
        });
        \Gate::define('admin', function ($user) {
            if ($user->id_privilege == 3) {
                return true;
            }
            return false;
        });
        \Gate::define('instructor', function ($user) {
            if ($user->id_privilege == 2) {
                return true;
            }
            return false;
        });
    }
}
