<?php

declare(strict_types=1);

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Product\Models\AttributeValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

covers(AttributeValue::class);

it('has an attribute relationship', function () {
    $relationship = new AttributeValue()?->attribute();
    $relatedModel = $relationship?->getRelated();

    expect($relationship)->toBeInstanceOf(BelongsTo::class);
    expect($relatedModel)->toBeInstanceOf(AttributeInterface::class);
});