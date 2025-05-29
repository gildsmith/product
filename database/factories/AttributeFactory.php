<?php

declare(strict_types=1);

namespace Gildsmith\Product\Database\Factories;

use Gildsmith\Product\Models\Attribute;
use Gildsmith\Product\Models\AttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('[a-z0-9_]{8}'),
            'name' => [
                'en' => ucfirst($this->faker->word),
                'pl' => ucfirst($this->faker->word),
            ],
        ];
    }

    public function hasValues(int $count = 1): static
    {
        return $this->has(AttributeValue::factory()->count($count), 'values');
    }
}
