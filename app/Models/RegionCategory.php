<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RegionCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Region[] $regions
 * @property-read int|null $regions_count
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegionCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RegionCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public static function table(): string
    {
        return (new self())->getTable();
    }

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
