<?php

declare(strict_types=1);

namespace Gildsmith\Product\Controllers\Product;

use Gildsmith\Support\Facades\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductDeleteController extends Controller
{
    public function __invoke(Request $request, string $code): bool
    {
        $force = $request->boolean('force');

        return Product::delete($code, $force);
    }
}
