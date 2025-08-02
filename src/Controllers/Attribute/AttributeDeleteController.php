<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute;

use Gildsmith\Contract\Product\AttributeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

class AttributeDeleteController extends Controller
{
    public function __invoke(string $code): bool
    {
        /** @var Model&AttributeInterface $attribute */
        $attribute = resolve(AttributeInterface::class)::where('code', $code)->firstOrFail();

        return (bool) $attribute->delete();
    }
}
