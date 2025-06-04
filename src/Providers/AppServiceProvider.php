<?php

declare(strict_types=1);

namespace Gildsmith\Product\Providers;

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Contract\Product\BlueprintInterface;
use Gildsmith\Contract\Product\ProductCollectionInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Gildsmith\Product\Models\Attribute;
use Gildsmith\Product\Models\AttributeValue;
use Gildsmith\Product\Models\Blueprint;
use Gildsmith\Product\Models\Product;
use Gildsmith\Product\Models\ProductCollection;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Facade
        $this->app->bind(\Gildsmith\Contract\Facades\Product::class, function () {
            return new \Gildsmith\Product\Facades\Product;
        });

        // Models
        $this->app->bind(AttributeValueInterface::class, AttributeValue::class);
        $this->app->bind(AttributeInterface::class, Attribute::class);
        $this->app->bind(BlueprintInterface::class, Blueprint::class);
        $this->app->bind(ProductInterface::class, Product::class);
        $this->app->bind(ProductCollectionInterface::class, ProductCollection::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));
    }

    /**
     * Helper function to build paths from the package root.
     */
    private function packagePath(string $path): string
    {
        return dirname(__DIR__, 2).'/'.$path;
    }
}
