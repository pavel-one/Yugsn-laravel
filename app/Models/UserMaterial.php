<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserMaterial
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $user_id
 * @property int $category_id
 * @property string $title
 * @property string $long_title
 * @property string|null $content
 * @property int $published
 * @property string|null $published_time
 * @property mixed|null $tags
 * @property string $slug
 * @property int $views
 * @property string|null $region_alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereLongTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial wherePublishedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereRegionAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereViews($value)
 */
class UserMaterial extends Model
{
    use HasFactory;
}
