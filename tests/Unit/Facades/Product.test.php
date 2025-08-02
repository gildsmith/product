<?php

declare(strict_types=1);

use Gildsmith\Contract\Product\ProductInterface;
use Gildsmith\Product\Exception\MissingSoftDeletesException;
use Gildsmith\Product\Facades\ProductFacade as ProductFacadeConcrete;
use Gildsmith\Product\Models\Product as ProductModel;
use Gildsmith\Support\Facades\Product as ProductFacade;
use Illuminate\Database\Eloquent\Model;

covers(ProductFacadeConcrete::class);

describe('all method', function () {
    it('returns all products', function () {
        ProductModel::factory()->count(3)->create();

        $products = ProductFacade::all();

        expect($products)->toHaveCount(3);
    });

    it('returns trashed products when second parameter is true', function () {
        ProductModel::factory()->count(2)->create();
        ProductModel::factory()->trashed()->count(1)->create();

        $products = ProductFacade::all(true);

        expect($products)->toHaveCount(3);
    });

    it('throws an exception if SoftDeletes is not used by a model', function () {
        bind(ProductInterface::class, function () {
            return new class extends Model implements ProductInterface {};
        });

        ProductFacade::all(true);
    })->throws(MissingSoftDeletesException::class);
});

describe('create method', function () {
    it('creates a product via the facade', function () {
        $mockProduct = Mockery::mock(ProductInterface::class);
        $mockProduct->allows('create')->once()->andReturns($mockProduct);

        bind(ProductInterface::class, fn () => $mockProduct);

        ProductFacade::create([]);
    });
});

describe('delete method', function () {
    // todo
});

describe('find method', function () {
    // todo
});

describe('restore method', function () {
    // todo
});

describe('trashed method', function () {
    it('returns only trashed products', function () {
        ProductModel::factory()->count(2)->create();
        ProductModel::factory()->trashed()->count(1)->create();

        $products = ProductFacade::trashed();

        expect($products->count())->toBe(1);
    });

    it('throws an exception if SoftDeletes is not used by a model', function () {
        bind(ProductInterface::class, function () {
            return new class implements ProductInterface {};
        });

        ProductFacade::trashed();
    })->throws(MissingSoftDeletesException::class);
});

describe('update method', function () {
    it('updates a product and returns a fresh instance', function () {
        $product = ProductModel::factory()->createOne();

        ProductFacade::partialMock()
            ->expects('find')
            ->andReturn($product)
            ->once();

        ProductFacade::update('code', []);
    });
});

describe('updateOrCreate method', function () {
    // todo
});
