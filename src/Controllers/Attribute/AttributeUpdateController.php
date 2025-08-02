<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute;

use Gildsmith\Contract\Product\AttributeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttributeUpdateController extends Controller
{
    public function __invoke(Request $request, string $code): AttributeInterface
    {
        /** @var Model&AttributeInterface $attribute */
        $attribute = resolve(AttributeInterface::class)::where('code', $code)->firstOrFail();

        $attribute->update($request->all());

        return $attribute->fresh();
    }
}
