<?php

declare(strict_types=1);

namespace Gildsmith\Product\Models;

use Gildsmith\Contract\Product\Attribute;
use Gildsmith\Contract\Product\AttributeValue as AttributeValueInterface;
use Gildsmith\Product\Database\Factories\AttributeValueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model implements AttributeValueInterface
{
    use HasFactory;
    use HasTranslations;

    public string $id;

    public string $code;

    public string $name;

    public Attribute $attribute;

    public array $translatable = ['name'];

    public $timestamps = false;

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    protected static function newFactory(): AttributeValueFactory
    {
        return AttributeValueFactory::new();
    }
}
