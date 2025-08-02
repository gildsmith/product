<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\AttributeValue;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;

class AttributeValueFindController extends Controller
{
    public function __invoke(string $code): ?AttributeValueInterface
    {
        /** @var Builder $builder */
        $builder = resolve(AttributeValueInterface::class);

        return $builder::where('code', $code)->first();
    }
}
