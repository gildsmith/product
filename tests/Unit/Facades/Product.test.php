<?php

declare(strict_types=1);

use Gildsmith\Contract\Facades\Product as ProductFacadeInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Gildsmith\Product\Models\Blueprint;
use Gildsmith\Product\Models\Product;

covers(\Gildsmith\Product\Facades\Product::class);

it('finds a product by code', function () {
    $model = Product::factory()->create();
    $facade = resolve(ProductFacadeInterface::class);

    $found = $facade->find($model->code);

    expect($found)->toBeInstanceOf(ProductInterface::class)
        ->and($found->id)->toBe($model->id);
});

it('returns null when product is missing', function () {
    $facade = resolve(ProductFacadeInterface::class);

    expect($facade->find('unknown'))->toBeNull();
});

it('can find trashed products when enabled', function () {
    $model = Product::factory()->create();
    $model->delete();
    $facade = resolve(ProductFacadeInterface::class);

    $without = $facade->find($model->code);
    $with = $facade->find($model->code, true);

    expect($without)->toBeNull()
        ->and($with?->id)->toBe($model->id);
});

it('returns all products optionally including trashed', function () {
    Product::factory()->count(2)->create();
    $trashed = Product::factory()->create();
    $trashed->delete();
    $facade = resolve(ProductFacadeInterface::class);

    $all = $facade->all();
    $withTrashed = $facade->all(true);

    expect($all)->toHaveCount(2)
        ->and($withTrashed)->toHaveCount(3);
});

it('lists only trashed products', function () {
    Product::factory()->count(2)->create();
    $trashed = Product::factory()->create();
    $trashed->delete();
    $facade = resolve(ProductFacadeInterface::class);

    $result = $facade->trashed();

    expect($result)->toHaveCount(1)
        ->and($result->first()->id)->toBe($trashed->id);
});

it('creates a product', function () {
    $blueprint = Blueprint::factory()->create();
    $facade = resolve(ProductFacadeInterface::class);

    $product = $facade->create([
        'blueprint_id' => $blueprint->id,
        'code' => 'test_code',
        'name' => ['en' => 'Test', 'pl' => 'Test'],
    ]);

    expect($product)->toBeInstanceOf(ProductInterface::class)
        ->and(Product::where('code', 'test_code')->exists())->toBeTrue();
});

it('updates a product by code', function () {
    $model = Product::factory()->create([
        'name' => ['en' => 'Old', 'pl' => 'Old'],
    ]);
    $facade = resolve(ProductFacadeInterface::class);

    $updated = $facade->update($model->code, [
        'name' => ['en' => 'New', 'pl' => 'New'],
    ]);

    expect($updated->name)->toBe(['en' => 'New', 'pl' => 'New']);
});

it('throws when updating unknown product', function () {
    $facade = resolve(ProductFacadeInterface::class);

    expect(fn () => $facade->update('unknown', []))
        ->toThrow(InvalidArgumentException::class);
});

it('updates or creates a product', function () {
    $model = Product::factory()->create(['code' => 'foo']);
    $facade = resolve(ProductFacadeInterface::class);

    $existing = $facade->updateOrCreate('foo', [
        'name' => ['en' => 'Bar', 'pl' => 'Bar'],
    ]);

    $new = $facade->updateOrCreate('new_code', [
        'blueprint_id' => Blueprint::factory()->create()->id,
        'name' => ['en' => 'Baz', 'pl' => 'Baz'],
    ]);

    expect($existing->name['en'])->toBe('Bar')
        ->and($new->code)->toBe('new_code');
});

it('soft deletes and force deletes products', function () {
    $soft = Product::factory()->create();
    $force = Product::factory()->create();
    $facade = resolve(ProductFacadeInterface::class);

    $facade->delete($soft->code);
    $facade->delete($force->code, true);

    $softDeleted = Product::withTrashed()->find($soft->id);
    $forceDeleted = Product::withTrashed()->find($force->id);

    expect($softDeleted->trashed())->toBeTrue()
        ->and($forceDeleted)->toBeNull();
});

it('restores a soft deleted product', function () {
    $model = Product::factory()->create();
    $model->delete();
    $facade = resolve(ProductFacadeInterface::class);

    $restored = $facade->restore($model->code);

    expect($restored)->toBeTrue()
        ->and(Product::find($model->id))->not->toBeNull();
});

it('returns false when restoring missing product', function () {
    $facade = resolve(ProductFacadeInterface::class);

    expect($facade->restore('missing-code'))->toBeFalse();
});
