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
        /** @var ProductInterface $model */
        $model = resolve(ProductInterface::class);

        $query = $withTrashed && method_exists($model, 'getDeletedAtColumn')
            ? $model::withTrashed()
            : $model::query();

        return $query->where('code', $code)->first();
    }

    public function all(bool $withTrashed = false): Collection
    {
        /** @var ProductInterface $model */
        $model = resolve(ProductInterface::class);

        $query = $withTrashed && method_exists($model, 'getDeletedAtColumn')
            ? $model::withTrashed()
            : $model::query();

        return $query->get();
    }

    public function trashed(): Collection
    {
        /** @var ProductInterface $model */
        $model = resolve(ProductInterface::class);

        return method_exists($model, 'onlyTrashed')
            ? $model::onlyTrashed()->get()
            : collect();
    }

    public function create(array $data): ProductInterface
    {
        /** @var ProductInterface $model */
        $model = resolve(ProductInterface::class);

        return $model::create($data);
    }

    public function update(string $code, array $data): ProductInterface
    {
        $product = $this->find($code, true);

        if (! $product) {
            throw new \InvalidArgumentException("Product with code {$code} not found.");
        }

        $product->update($data);

        return $product->fresh();
    }

    public function updateOrCreate(string $code, array $data): ProductInterface
    {
        /** @var ProductInterface $model */
        $model = resolve(ProductInterface::class);

        return $model::updateOrCreate(['code' => $code], $data);
    }

    public function delete(string $code, bool $force = false): bool
    {
        /** @var ProductInterface $model */
        $model = resolve(ProductInterface::class);

        $query = $model::where('code', $code);

        return $force
            ? (bool) $query->forceDelete()
            : (bool) $query->delete();
    }

    public function restore(string $code): bool
    {
        $product = $this->find($code, true);

        if (! $product || ! method_exists($product, 'restore')) {
            return false;
        }

        return (bool) $product->restore();
    }
}
