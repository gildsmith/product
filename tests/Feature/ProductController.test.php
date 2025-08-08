<?php

declare(strict_types=1);

use Gildsmith\Product\Models\Product;

it('shows a product', function () {
    $product = Product::factory()->create();

    $response = $this->getJson("/products/{$product->code}");

    $response->assertOk()->assertJsonPath('code', $product->code);
});

it('returns 404 when product is missing', function () {
    $response = $this->getJson('/products/missing');

    $response->assertNotFound();
});
