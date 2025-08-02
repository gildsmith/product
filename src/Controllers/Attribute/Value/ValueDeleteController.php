<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute\Value;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Support\Facades\Product;
use Illuminate\Routing\Controller;

class ValueDeleteController extends Controller
{
    public function __invoke(string $attribute, string $value): bool
    {
        $attributeModel = Product::attribute()->find($attribute);

        /** @var AttributeValueInterface $valueModel */
        $valueModel = $attributeModel->values()->where('code', $value)->firstOrFail();

        return (bool) $valueModel->delete();
    }
}
