<?php

declare(strict_types=1);

namespace Gildsmith\Product\Models;

use Gildsmith\Contract\Product\Attribute as AttributeInterface;
use Gildsmith\Contract\Product\AttributeValue as AttributeValueInterface;
use Gildsmith\Product\Database\Factories\AttributeFactory;
use Gildsmith\Support\Utils\ValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model implements AttributeInterface
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['name'];

    public $timestamps = false;

    public array $rules = [
        'code' => ValidationRules::CODE,
    ];

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValueInterface::class);
    }

    protected static function newFactory(): AttributeFactory
    {
        return AttributeFactory::new();
    }
}
