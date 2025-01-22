<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        $this->loadRoutes();
    }

    /**
     * Load API and Web Routes.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        // Load API Routes
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));

        // Load Web Routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
