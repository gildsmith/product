<?php

declare(strict_types=1);

use Gildsmith\Product\Models\Attribute;
use Gildsmith\Product\Models\AttributeValue;

it('lists attribute values', function () {
    $attribute = Attribute::factory()->create();
    AttributeValue::factory()->count(3)->for($attribute)->create();

    $response = $this->getJson("/attributes/{$attribute->code}/values");

    $response->assertOk()->assertJsonCount(3);
});

it('creates an attribute value', function () {
    $attribute = Attribute::factory()->create();

    $payload = [
        'code' => 'red',
        'name' => ['en' => 'Red', 'pl' => 'Czerwony'],
    ];

    $response = $this->postJson("/attributes/{$attribute->code}/values", $payload);

    $response->assertCreated()->assertJsonPath('code', 'red');
    $this->assertDatabaseHas('attribute_values', ['code' => 'red', 'attribute_id' => $attribute->id]);
});

it('shows an attribute value', function () {
    $value = AttributeValue::factory()->for(Attribute::factory())->create();

    $response = $this->getJson("/attributes/{$value->attribute->code}/values/{$value->code}");

    $response->assertOk()->assertJsonPath('code', $value->code);
});

it('updates an attribute value', function () {
    $value = AttributeValue::factory()->for(Attribute::factory())->create();

    $response = $this->putJson("/attributes/{$value->attribute->code}/values/{$value->code}", [
        'name' => ['en' => 'Updated', 'pl' => 'Zaktualizowany'],
    ]);

    $response->assertOk()->assertJsonPath('name.en', 'Updated');
    $this->assertDatabaseHas('attribute_values', ['code' => $value->code, 'name->en' => 'Updated']);
});

it('deletes an attribute value', function () {
    $value = AttributeValue::factory()->for(Attribute::factory())->create();

    $response = $this->deleteJson("/attributes/{$value->attribute->code}/values/{$value->code}");

    $response->assertOk();
    expect($response->json())->toEqual(true);
    $this->assertSoftDeleted('attribute_values', ['code' => $value->code]);
});
