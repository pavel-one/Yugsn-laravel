<?php /** @noinspection PhpSuperClassIncompatibleWithInterfaceInspection */

namespace App\Models;

use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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
 * @property \Illuminate\Support\Carbon|null $published_time
 * @property mixed|null $tags
 * @property string $slug
 * @property int $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $regions
 * @property-read \App\Models\MaterialCategory $category
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $user
 * @method static Builder|UserMaterial newModelQuery()
 * @method static Builder|UserMaterial newQuery()
 * @method static Builder|UserMaterial query()
 * @method static Builder|UserMaterial whereCategoryId($value)
 * @method static Builder|UserMaterial whereContent($value)
 * @method static Builder|UserMaterial whereCreatedAt($value)
 * @method static Builder|UserMaterial whereId($value)
 * @method static Builder|UserMaterial whereLongTitle($value)
 * @method static Builder|UserMaterial wherePublished($value)
 * @method static Builder|UserMaterial wherePublishedTime($value)
 * @method static Builder|UserMaterial whereRegions($value)
 * @method static Builder|UserMaterial whereSlug($value)
 * @method static Builder|UserMaterial whereTags($value)
 * @method static Builder|UserMaterial whereTitle($value)
 * @method static Builder|UserMaterial whereUpdatedAt($value)
 * @method static Builder|UserMaterial whereUserId($value)
 * @method static Builder|UserMaterial whereViews($value)
 * @mixin \Eloquent
 */
class UserMaterial extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $casts = [
        'regions' => 'array'
    ];

    public const MINI_FIELDS = [
        'id',
        'user_id',
        'category_id',
        'title',
        'published_time',
        'tags',
        'slug',
        'views',
        'regions'
    ];

    public const THUMB_SIZES = [
        'normal' => [360, 234],
        'normal-big' => [623, 405],
        'normal-horizon' => [458, 229],
        'small-big' => [458, 492],
        'small-vertical' => [263, 320],
        'small-horizon' => [326, 236],
        'mini' => [110, 130],
        'mini-vertical' => [330, 291],
    ];

    protected $dates = [
        'published_time',
    ];

    /**
     * Для миниатюры материала
     * @param MaterialCategory|null $category - категория
     * @param bool $content - С контентом
     * @param bool $relations - связи
     * @return Builder
     */
    public static function findMini($category = null, bool $content = false, bool $relations = true): Builder
    {
        $fields = self::MINI_FIELDS;

        if ($content) {
            $fields = array_merge($fields, ['content']);
        }

        $query = self::wherePublished(true)
            ->select($fields)
            ->orderByDesc('published_time');

        if ($relations) {
            $query->with('category', function ($query) {
                $query->select(['id', 'name', 'slug']);
            });
            $query->with('user', function ($query) {
                $query->select(['id', 'name']);
            });
        }

        if ($category instanceof MaterialCategory) {
            $query->where('category_id', $category->id);
        }

        if ($region_id = RouteServiceProvider::getCurrentRegionId()) {
            $query->whereRaw("JSON_CONTAINS(regions, '\"$region_id\"', '$')");
        }

        return $query;
    }

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

    /**
     * Название категории
     * @return string
     */
    public function getNameCategory(): string
    {
        return $this->category->name;
    }

    /**
     * Ссылка на категорию
     * @return string
     */
    public function getLinkCategory(): string
    {
        return route('category.material', $this->category->slug);
    }

    /**
     * Ссылка на материал
     * @return string
     */
    public function getLink(): string
    {
        return route('category.material', $this->slug);
    }

    /**
     * Время публикации материала
     * @return string
     */
    public function getPublishedTime(): string
    {
        return $this->published_time->diffForHumans();
    }

    /**
     * Ссылка на регион
     * @return string|null
     */
    public function getLinkRegion(): ?string
    {
        if (!$this->regions) {
            return null;
        }
        $region = $this->getRegionObj();
        if (!$region) {
            return null;
        }

        return URL::formatScheme() . $region->alias . '.' . env('APP_BASE_URL');
    }

    /**
     * Отдает имя региона
     * @return string|null
     */
    public function getNameRegion(): ?string
    {
        if (!$this->regions) {
            return null;
        }

        $region = $this->getRegionObj();
        if (!$region) {
            return null;
        }

        return $region->name;
    }

    /**
     * Ссылка на автора
     * @return string
     */
    public function getAuthorLink(): string
    {
        return '#';
    }

    /**
     * Имя автора материала
     * @return string
     */
    public function getAuthorName(): string
    {
        return 'Администратор Администраторович';
    }

    /**
     * Отдает краткое содержание статьи
     * @param int $words - Количество слов
     * @param bool $html - Включить html теги
     * @return string
     */
    public function getSmallContent($words = 40, $html = false): string
    {
        if (!$this->content) {
            return 'Статья находится в разработке';
        }

        $text = \Str::words($this->content, $words);

        if (!$html) {
            $text = strip_tags($text);
        }

        return $text;
    }

    /**
     * Создание алиаса статьи, при сохранении
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Создание миниатюры [Очередь]
     *
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        foreach (self::THUMB_SIZES as $name => $size) {
            $this->addMediaConversion("thumb-$name")
                ->fit(Manipulations::FIT_CROP, $size[0], $size[1]);
        }
    }

    /**
     * Получает первый регион материала
     * @return null
     */
    private function getRegionObj(): ?Region
    {
        $region = \Cache::remember('region-obj-id-' . $this->id, 60 * 10, function () {
            return Region::whereId($this->regions[0])->first();
        });
        if (!$region) {
            return null;
        }

        return $region;
    }
}
