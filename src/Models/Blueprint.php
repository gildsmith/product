<?php

declare(strict_types=1);

namespace Gildsmith\Product\Models;

use Gildsmith\Contract\Product\AttributeInterface;
use Gildsmith\Contract\Product\BlueprintInterface;
use Gildsmith\Contract\Product\ProductInterface;
use Gildsmith\Product\Database\Factories\BlueprintFactory;
use Gildsmith\Support\Model\Concerns\HasAbstractRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Blueprint extends Model implements BlueprintInterface
{
    use HasAbstractRelationships;
    use HasFactory;
    use HasTranslations;

    public $timestamps = false;

    protected array $translatable = ['name'];

    protected static function newFactory(): BlueprintFactory
    {
        return BlueprintFactory::new();
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(AttributeInterface::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(ProductInterface::class);
    }

    public function allows(string ...$properties): bool
    {
        // TODO: Implement allows() method.
        return false;
    }

    public function requires(string ...$properties): bool
    {
        // TODO: Implement requires() method.
        return false;
    }
}
