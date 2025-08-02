<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Attribute;

use Gildsmith\Contract\Product\AttributeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class AttributeIndexController extends Controller
{
    public function __invoke(): Collection
    {
        /** @var Builder $builder */
        $builder = resolve(AttributeInterface::class);

        return $builder->get();
    }
}
