<?php

declare(strict_types=1);

namespace Gildsmith\Product\Facades;

use Gildsmith\Contract\Facades\Product as ProductFacadeInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Product implements ProductFacadeInterface
{
    public function all(bool $withTrashed = false): Collection
    {
        /** @var Builder $builder */
        $builder = resolve(ProductInterface::class);

        return $withTrashed
            ? $builder::withTrashed()->get()
            : $builder->get();
    }

    public function trashed(): Collection
    {
        /** @var Builder $builder */
        $builder = resolve(ProductInterface::class);

        return $builder::onlyTrashed()->get();
    }

    public function create(array $data): ProductInterface
    {
        /** @var Builder $builder */
        $builder = resolve(ProductInterface::class);

        return $builder::create($data);
    }

    public function update(string $code, array $data): ProductInterface
    {
        $product = $this->find($code, true);

        $product->update($data);

        return $product->fresh();
    }

    public function find(string $code, bool $withTrashed = false): ?ProductInterface
    {
        /** @var Builder $builder */
        $builder = resolve(ProductInterface::class);

        return $withTrashed
            ? $builder::withTrashed()->where('code', $code)->first()
            : $builder::where('code', $code)->first();
    }

    public function updateOrCreate(string $code, array $data): ProductInterface
    {
        /** @var Builder $builder */
        $builder = resolve(ProductInterface::class);

        return $builder::updateOrCreate(['code' => $code], $data);
    }

    public function delete(string $code, bool $force = false): bool
    {
        $product = $this->find($code);

        return $force
            ? (bool) $product->forceDelete()
            : (bool) $product->delete();
    }

    public function restore(string $code): bool
    {
        return $this->find($code, true)->restore();
    }
}
