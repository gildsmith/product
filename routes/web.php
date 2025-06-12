<?php

use Gildsmith\Product\Controllers\Product\ProductIndexController;

Route::prefix('products')->group(function () {
    Route::get('/', ProductIndexController::class);
});