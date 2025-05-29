<?php

declare(strict_types=1);

use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Product\Models\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

covers(Attribute::class);

it('has a values relationship', function () {
    $relationship = new Attribute()?->values();
    $relatedModel = $relationship?->getRelated();

    expect($relationship)->toBeInstanceOf(HasMany::class);
    expect($relatedModel)->toBeInstanceOf(AttributeValueInterface::class);
});