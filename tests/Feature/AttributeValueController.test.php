<?php

declare(strict_types=1);

use Gildsmith\Product\Models\Attribute;
use Gildsmith\Product\Models\AttributeValue;

it('lists attribute values', function () {
    AttributeValue::factory()->count(3)->create();

    $response = $this->getJson('/attribute-values');

    $response->assertOk()->assertJsonCount(3);
});

it('creates an attribute value', function () {
    $attribute = Attribute::factory()->create();

    $payload = [
        'attribute_id' => $attribute->id,
        'code' => 'red',
        'name' => ['en' => 'Red', 'pl' => 'Czerwony'],
    ];

    $response = $this->postJson('/attribute-values', $payload);

    $response->assertCreated()->assertJsonPath('code', 'red');
    $this->assertDatabaseHas('attribute_values', ['code' => 'red']);
});

it('shows an attribute value', function () {
    $value = AttributeValue::factory()->create();

    $response = $this->getJson("/attribute-values/{$value->code}");

    $response->assertOk()->assertJsonPath('code', $value->code);
});

it('updates an attribute value', function () {
    $value = AttributeValue::factory()->create();

    $response = $this->putJson("/attribute-values/{$value->code}", [
        'name' => ['en' => 'Updated', 'pl' => 'Zaktualizowany'],
    ]);

    $response->assertOk()->assertJsonPath('name.en', 'Updated');
    $this->assertDatabaseHas('attribute_values', ['code' => $value->code, 'name->en' => 'Updated']);
});

it('deletes an attribute value', function () {
    $value = AttributeValue::factory()->create();

    $response = $this->deleteJson("/attribute-values/{$value->code}");

    $response->assertOk();
    expect($response->json())->toEqual(true);
    $this->assertDatabaseMissing('attribute_values', ['code' => $value->code]);
});
