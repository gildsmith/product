<?php

declare(strict_types=1);

namespace Gildsmith\Product\Facades;

use Gildsmith\Contract\Facades\Product as ProductFacadeInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
    private function usesSoftDeletes(ProductInterface $model): bool
    {
        // check trait usage; fallback to method existence if helpers are not available
        if (function_exists('class_uses_recursive')) {
            return in_array(SoftDeletes::class, class_uses_recursive($model), true);
        }

        return in_array(SoftDeletes::class, class_uses($model), true);
    }

        $query = $withTrashed && $this->usesSoftDeletes($model)
        $query = $withTrashed && $this->usesSoftDeletes($model)
        return $this->usesSoftDeletes($model)

        if ($force && $this->usesSoftDeletes($model)) {
            return (bool) $query->forceDelete();
        }

        return (bool) $query->delete();
    {
        if (! $product || ! $this->usesSoftDeletes($product)) {
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

        if (! $product) {
            throw new \InvalidArgumentException("Product with code {$code} not found.");
        }

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
        return $force
            ? (bool) $this->find($code)->forceDelete()
            : (bool) $this->find($code)->delete();
    }

    public function restore(string $code): bool
    {
        $product = $this->find($code, true);

        // todo check whether class uses SoftDeletes rather than have some method implemented.
        return $product->restore();
    }
}
