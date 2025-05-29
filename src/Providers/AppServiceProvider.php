<?php

declare(strict_types=1);

namespace Gildsmith\Product\Providers;

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Product\Models\Attribute;
use Gildsmith\Product\Models\AttributeValue;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * List of actions provided by this package
     * that can be executed as Artisan commands.
     */
    protected array $commands = [
        //
    ];

    public function register(): void
    {
        $this->app->bind(AttributeValueInterface::class, AttributeValue::class);
        $this->app->bind(AttributeInterface::class, Attribute::class);
    }

    public function boot(): void
    {
        $this->bootResources();
        $this->bootCommands();
    }

    /**
     * Loads and merges Gildsmith package resources
     * and setups publishable resources.
     */
    public function bootResources(): void
    {
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));
    }

    /**
     * Helper function to build paths from the package root.
     */
    private function packagePath(string $path): string
    {
        return dirname(__DIR__, 2) . '/' . $path;
    }

    /**
     * Registers commands defined in the $commands
     * array when running in the console.
     */
    public function bootCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }
}
