<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute\Value;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Support\Facades\Product;
use Illuminate\Routing\Controller;

class ValueFindController extends Controller
{
    public function __invoke(string $attribute, string $value): ?AttributeValueInterface
    {
        $attributeModel = Product::attribute()->find($attribute);

        return $attributeModel->values()->where('code', $value)->first();
    }
}
