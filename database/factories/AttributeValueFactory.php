<?php

declare(strict_types=1);

namespace Gildsmith\Product\Database\Factories;

use Gildsmith\Product\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeValueFactory extends Factory
{
    public function definition(): array
    {
        $code = $this->faker->unique()->regexify('[a-z0-9._]{8}');

        return [
            'code' => $code,
            'name' => ['en' => ucfirst($code)],
            'attribute_id' => Attribute::factory(),
        ];
    }
}
