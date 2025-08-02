<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\AttributeValue;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

class AttributeValueDeleteController extends Controller
{
    public function __invoke(string $code): bool
    {
        /** @var Model&AttributeValueInterface $value */
        $value = resolve(AttributeValueInterface::class)::where('code', $code)->firstOrFail();

        return (bool) $value->delete();
    }
}
