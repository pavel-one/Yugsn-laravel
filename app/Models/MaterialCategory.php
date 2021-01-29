<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\MaterialCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $special
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory whereUpdatedAt($value)
 */
class MaterialCategory extends Model
{
    use HasFactory;

    public static function table(): string
    {
        return (new MaterialCategory)->getTable();
    }

    public function materials(): HasMany
    {
        return $this->hasMany(UserMaterial::class, 'category_id', 'id');
    }
}
