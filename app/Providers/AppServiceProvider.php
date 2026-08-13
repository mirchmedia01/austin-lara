<?php

namespace App\Providers;

use App\Support\TrailingSlashUrlGenerator;
use Closure;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();

            $app->instance('routes', $routes);

            return new TrailingSlashUrlGenerator(
                $routes,
                $app->rebinding('request', $this->urlRequestRebinder()),
                $app['config']['app.asset_url'],
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Get the URL generator request rebinder.
     */
    protected function urlRequestRebinder(): Closure
    {
        return function ($app, $request) {
            $app['url']->setRequest($request);
        };
    }
}
