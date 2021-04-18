<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaterialTags
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaterialTags whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MaterialTags extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Создает или возвращает существующий тег
     * @param string $name
     * @return MaterialTags
     */
    public static function createOrReturn(string $name): self
    {
        $query = self::whereName($name);

        if ($query->exists()) {
            return $query->first();
        }

        return self::create([
            'name' => $name
        ]);
    }
}
