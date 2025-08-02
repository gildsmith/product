<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute;

use Gildsmith\Contract\Product\AttributeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttributeCreateController extends Controller
{
    public function __invoke(Request $request): AttributeInterface
    {
        /** @var Builder $builder */
        $builder = resolve(AttributeInterface::class);

        return $builder::forceCreate($request->all());
    }
}
