<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapRoutes();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapRoutes()
    {
        Route::group(['namespace' => "{$this->namespace}", 'middleware' => 'api'], function (Registrar $router) {
            foreach ($this->getRouteFiles() as $file) {
                $namespace = basename($file, '.php');

                $router->group(['namespace' => $namespace], function (Registrar $router) use ($namespace) {
                    $this->app->make("App\\Http\\Routes\\$namespace")->map($router);
                });
            }
        });
    }

    /**
     * @return array
     */
    private function getRouteFiles()
    {
        return glob(app_path('Http//Routes') . '/*.php');
    }
}
