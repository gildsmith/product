<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute\Value;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Support\Facades\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ValueUpdateController extends Controller
{
    public function __invoke(Request $request, string $attribute, string $value): AttributeValueInterface
    {
        $attributeModel = Product::attribute()->find($attribute);

        /** @var AttributeValueInterface $valueModel */
        $valueModel = $attributeModel->values()->where('code', $value)->firstOrFail();

        $valueModel->update($request->all());

        return $valueModel->fresh();
    }
}
