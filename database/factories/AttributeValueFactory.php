<?php

declare(strict_types=1);

namespace Gildsmith\Product\Database\Factories;

use Gildsmith\Product\Models\Attribute;
use Gildsmith\Product\Models\AttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;

    public function definition(): array
    {
        $code = $this->faker->unique()->regexify('[a-z0-9._]{8}');

        return [
            'attribute_id' => Attribute::factory(),
            'code' => $code,
            'name' => [
                'en' => ucfirst($this->faker->word),
                'pl' => ucfirst($this->faker->word),
            ],

        ];
    }
}
