<?php

declare(strict_types=1);

namespace Gildsmith\Product\Facades;

use Gildsmith\Contract\Facades\Product as ProductFacadeInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Illuminate\Support\Collection;

class Product implements ProductFacadeInterface
{
    public function find(string $code, bool $withTrashed = false): ?ProductInterface
    {
        // TODO: Implement find() method.
    }

    public function all(bool $withTrashed = false): Collection
    {
        // TODO: Implement all() method.
    }

    public function trashed(): Collection
    {
        // TODO: Implement trashed() method.
    }

    public function create(array $data): ProductInterface
    {
        // TODO: Implement create() method.
    }

    public function update(string $code, array $data): ProductInterface
    {
        // TODO: Implement update() method.
    }

    public function updateOrCreate(string $code, array $data): ProductInterface
    {
        // TODO: Implement updateOrCreate() method.
    }

    public function delete(string $code, bool $force = false): bool
    {
        // TODO: Implement delete() method.
    }

    public function restore(string $code): bool
    {
        // TODO: Implement restore() method.
    }
}
