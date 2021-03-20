<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\MaterialCategory
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $special
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $sort
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserMaterial[] $materials
 * @property-read int|null $materials_count
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MaterialCategory extends Model
{
    use HasFactory, HasSlug;

    public static function table(): string
    {
        return (new MaterialCategory)->getTable();
    }

    public function materials(): HasMany
    {
        return $this->hasMany(UserMaterial::class, 'category_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getLink(): string
    {
        return route('category.material', $this->slug);
    }
}
