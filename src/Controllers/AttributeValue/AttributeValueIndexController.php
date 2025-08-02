<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\AttributeValue;

use Gildsmith\Contract\Product\AttributeValueInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class AttributeValueIndexController extends Controller
{
    public function __invoke(): Collection
    {
        /** @var Builder $builder */
        $builder = resolve(AttributeValueInterface::class);

        return $builder->get();
    }
}
