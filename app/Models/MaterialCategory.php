<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaterialCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialCategory query()
 * @mixin \Eloquent
 */
class MaterialCategory extends Model
{
    use HasFactory;

    public static function table(): string
    {
        return (new MaterialCategory)->getTable();
    }
}
