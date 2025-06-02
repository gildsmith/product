<?php

declare(strict_types=1);

use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Contract\Product\BlueprintInterface;
use Gildsmith\Product\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

covers(Product::class);

it('has attributes relationship', function () {
    $model = Product::factory()->hasAttributeValues(3)->create();

    $relationship = $model->attributeValues();
    $relatedModel = $relationship->getRelated();
    $collectionCount = $model->attributeValues->count();

    expect($collectionCount)->toBe(3);
    expect($relationship)->toBeInstanceOf(BelongsToMany::class);
    expect($relatedModel)->toBeInstanceOf(AttributeValueInterface::class);
});

it('has blueprint relationship', function () {
    $model = Product::factory()->create();

    $relationship = $model->blueprint();
    $relatedModel = $model->blueprint;

    expect($relationship)->toBeInstanceOf(BelongsTo::class);
    expect($relatedModel)->toBeInstanceOf(BlueprintInterface::class);
});

it('has collections relationship', function () {
    $model = Product::factory()->hasProductCollections(3)->create();

    $relationship = $model->productCollections();
    $relatedModel = $relationship->getRelated();
    $collectionCount = $model->productCollections->count();

    expect($collectionCount)->toBe(3);
    expect($relationship)->toBeInstanceOf(BelongsToMany::class);
    expect($relatedModel)->toBeInstanceOf(\Gildsmith\Contract\Product\ProductCollectionInterface::class);
});
