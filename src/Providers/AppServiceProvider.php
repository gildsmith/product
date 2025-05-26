<?php

declare(strict_types=1);

namespace Gildsmith\Product\Providers;

use Gildsmith\Product\Product;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('gildsmith', fn () => new Product);

    }

    public function boot(): void
    {
        $this->bootResources();
    }

    /**
     * Loads and merges Gildsmith package resources
     * and setups publishable resources.
     */
    public function bootResources(): void
    {
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));
        // $this->loadViewsFrom($this->packagePath('resources/views'), 'gildsmith');
        // $this->publishes([$this->packagePath('resources/views') => resource_path('views/vendor/gildsmith')], 'views');
    }

    /**
     * Helper function to build paths from the package root.
     */
    private function packagePath(string $path): string
    {
        return dirname(__DIR__, 2).'/'.$path;
    }
}
