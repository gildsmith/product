<?php

declare(strict_types=1);

namespace Gildsmith\Product\Models;

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Contract\Product\AttributeValueInterface;
use Gildsmith\Product\Database\Factories\AttributeValueFactory;
use Gildsmith\Support\Model\Concerns\HasAbstractRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model implements AttributeValueInterface
{
    use HasAbstractRelationships;
    use HasFactory;
    use HasTranslations;

    public AttributeInterface $attribute;

    public array $translatable = ['name'];

    public $timestamps = false;

    protected static function newFactory(): AttributeValueFactory
    {
        return AttributeValueFactory::new();
    }

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(AttributeInterface::class);
    }
}
