<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $parent
 * @property int|null $parent_comment
 * @property int|null $user_id
 * @property string $theme
 * @property string|null $username
 * @property string|null $ip
 * @property string|null $email
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $show
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $children
 * @property-read int|null $children_count
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUsername($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_comment', 'id')
            ->where('show', '=', true);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
