<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute;

use Gildsmith\Contract\Product\AttributeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;

class AttributeFindController extends Controller
{
    public function __invoke(string $code): ?AttributeInterface
    {
        /** @var Builder $builder */
        $builder = resolve(AttributeInterface::class);

        return $builder::where('code', $code)->first();
    }
}
