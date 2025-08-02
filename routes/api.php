<?php

declare(strict_types=1);

use Gildsmith\Product\Controllers\Product\ProductCreateController;
use Gildsmith\Product\Controllers\Product\ProductDeleteController;
use Gildsmith\Product\Controllers\Product\ProductFindController;
use Gildsmith\Product\Controllers\Product\ProductIndexController;
use Gildsmith\Product\Controllers\Product\ProductRestoreController;
use Gildsmith\Product\Controllers\Product\ProductTrashedController;
use Gildsmith\Product\Controllers\Product\ProductUpdateController;
use Gildsmith\Product\Controllers\Attribute\AttributeCreateController;
use Gildsmith\Product\Controllers\Attribute\AttributeDeleteController;
use Gildsmith\Product\Controllers\Attribute\AttributeFindController;
use Gildsmith\Product\Controllers\Attribute\AttributeIndexController;
use Gildsmith\Product\Controllers\Attribute\AttributeUpdateController;
use Gildsmith\Product\Controllers\AttributeValue\AttributeValueCreateController;
use Gildsmith\Product\Controllers\AttributeValue\AttributeValueDeleteController;
use Gildsmith\Product\Controllers\AttributeValue\AttributeValueFindController;
use Gildsmith\Product\Controllers\AttributeValue\AttributeValueIndexController;
use Gildsmith\Product\Controllers\AttributeValue\AttributeValueUpdateController;

Route::prefix('products')->group(function () {
    Route::get('/', ProductIndexController::class);
    Route::post('/', ProductCreateController::class);
    Route::get('/trashed', ProductTrashedController::class);
    Route::get('/{code}', ProductFindController::class);
    Route::put('/{code}', ProductUpdateController::class);
    Route::patch('/{code}', ProductUpdateController::class);
    Route::delete('/{code}', ProductDeleteController::class);
    Route::post('/{code}/restore', ProductRestoreController::class);
});

Route::prefix('attributes')->group(function () {
    Route::get('/', AttributeIndexController::class);
    Route::post('/', AttributeCreateController::class);
    Route::get('/{code}', AttributeFindController::class);
    Route::put('/{code}', AttributeUpdateController::class);
    Route::patch('/{code}', AttributeUpdateController::class);
    Route::delete('/{code}', AttributeDeleteController::class);
});

Route::prefix('attribute-values')->group(function () {
    Route::get('/', AttributeValueIndexController::class);
    Route::post('/', AttributeValueCreateController::class);
    Route::get('/{code}', AttributeValueFindController::class);
    Route::put('/{code}', AttributeValueUpdateController::class);
    Route::patch('/{code}', AttributeValueUpdateController::class);
    Route::delete('/{code}', AttributeValueDeleteController::class);
});
