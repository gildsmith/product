<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute\Value;

use Gildsmith\Support\Facades\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class ValueIndexController extends Controller
{
    public function __invoke(string $attribute): Collection
    {
        $attributeModel = Product::attribute()->find($attribute);

        return $attributeModel->values;
    }
}
