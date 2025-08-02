<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute;

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Support\Facades\Product;
use Illuminate\Routing\Controller;

class AttributeFindController extends Controller
{
    public function __invoke(string $code): ?AttributeInterface
    {
        return Product::attribute()->find($code);
    }
}
