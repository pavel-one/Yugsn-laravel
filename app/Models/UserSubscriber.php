<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSubscriber
 *
 * @property int $id
 * @property string $email
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSubscriber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserSubscriber extends Model
{
    protected $fillable = ['email'];
    //TODO: Уведомление при подписке
}
