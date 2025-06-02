<?php

declare(strict_types=1);

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Gildsmith\Product\Models\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

covers(Blueprint::class);

it('has attributes relationship', function () {
    $model = Blueprint::factory()->hasAttributes(3)->create();

    $relationship = $model->attributes();
    $relatedModel = $relationship?->getRelated();
    $collectionCount = $model->attributes->count();

    expect($collectionCount)->toBe(3);
    expect($relationship)->toBeInstanceOf(BelongsToMany::class);
    expect($relatedModel)->toBeInstanceOf(AttributeInterface::class);
});

it('has products relationship', function () {
    $model = Blueprint::factory()->hasProducts(3)->create();

    $relationship = $model->products();
    $relatedModel = $relationship?->getRelated();
    $collectionCount = $model->products->count();

    expect($collectionCount)->toBe(3);
    expect($relationship)->toBeInstanceOf(HasMany::class);
    expect($relatedModel)->toBeInstanceOf(ProductInterface::class);
});
