<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaterialTags
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereUpdatedAt($value)
 */
class MaterialTags extends Model
{
    use HasFactory;
}
