<?php

declare(strict_types=1);

use Gildsmith\Product\Models\ProductCollection;

it('lists product collections', function () {
    ProductCollection::factory()->count(3)->create();

    $response = $this->getJson('/collections');

    $response->assertOk()->assertJsonCount(3);
});

it('creates a product collection', function () {
    $payload = [
        'code' => 'summer',
        'type' => 'season',
        'name' => ['en' => 'Summer', 'pl' => 'Lato'],
    ];

    $response = $this->postJson('/collections', $payload);

    $response->assertCreated()->assertJsonPath('code', 'summer');
    $this->assertDatabaseHas('product_collections', ['code' => 'summer']);
});

it('shows a product collection', function () {
    $collection = ProductCollection::factory()->create();

    $response = $this->getJson("/collections/{$collection->code}");

    $response->assertOk()->assertJsonPath('code', $collection->code);
});

it('updates a product collection', function () {
    $collection = ProductCollection::factory()->create();

    $response = $this->putJson("/collections/{$collection->code}", [
        'name' => ['en' => 'Updated', 'pl' => 'Zaktualizowany'],
    ]);

    $response->assertOk()->assertJsonPath('name.en', 'Updated');
    $this->assertDatabaseHas('product_collections', ['code' => $collection->code, 'name->en' => 'Updated']);
});

it('deletes a product collection', function () {
    $collection = ProductCollection::factory()->create();

    $response = $this->deleteJson("/collections/{$collection->code}");

    $response->assertOk();
    expect($response->json())->toEqual(true);
    $this->assertDatabaseMissing('product_collections', ['code' => $collection->code]);
});
