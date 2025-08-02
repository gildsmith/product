<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\AttributeValue;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttributeValueUpdateController extends Controller
{
    public function __invoke(Request $request, string $code): AttributeValueInterface
    {
        /** @var Model&AttributeValueInterface $value */
        $value = resolve(AttributeValueInterface::class)::where('code', $code)->firstOrFail();

        $value->update($request->all());

        return $value->fresh();
    }
}
