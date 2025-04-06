<?php

namespace App\Models;

use App\Enums\Currency;
use App\Enums\PriceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property Currency $currency
 * @property PriceType $price_type
 * @property integer $city_id
 * @property string $phone
 * @property boolean $has_whatsapp
 * @property boolean $has_telegram
 * @property string $latitude
 * @property string $longitude
 * @property string $status
 * @property string $expires_at
 * @property int $views
 *
 * @property User $user
 * @property City $city
 * @property Resort $resort
 *
 * @method void increment(string $column, int $amount = 1, array $extra = [])
 */
class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'listings';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'currency',
        'price_type',
        'city_id',
        'resort_id',
        'phone',
        'has_whatsapp',
        'has_telegram',
        'latitude',
        'longitude',
        'status',
        'expires_at',
        'views',
    ];

    protected $casts = [
        'has_whatsapp' => 'boolean',
        'has_telegram' => 'boolean',
        'currency'     => Currency::class,
        'price_type'   => PriceType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function resort(): BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }
}
