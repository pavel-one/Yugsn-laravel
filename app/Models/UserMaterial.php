<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\UserMaterial
 *
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $regions
 * @property-read \App\Models\MaterialCategory $category
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereLongTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial wherePublishedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereRegions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMaterial whereViews($value)
 * @mixin \Eloquent
 */
class UserMaterial extends Model
{
    use HasFactory, HasSlug, InteractsWithMedia;

    public static function table(): string
    {
        return (new UserMaterial())->getTable();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MaterialCategory::class, 'category_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
