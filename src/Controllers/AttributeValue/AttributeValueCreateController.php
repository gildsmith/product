<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\AttributeValue;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttributeValueCreateController extends Controller
{
    public function __invoke(Request $request): AttributeValueInterface
    {
        /** @var Builder $builder */
        $builder = resolve(AttributeValueInterface::class);

        return $builder::forceCreate($request->all());
    }
}
