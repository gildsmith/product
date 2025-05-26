<?php

declare(strict_types=1);

use Gildsmith\Product\Models\Attribute;

covers(Attribute::class);

it('can be created via factory', function () {
    $attribute = Attribute::factory()->create();

    expect($attribute)->toBeInstanceOf(Attribute::class)
        ->and($attribute->code)->toBeString()
        ->and($attribute->getTranslations('name'))->toHaveKeys(['en', 'pl']);
});
