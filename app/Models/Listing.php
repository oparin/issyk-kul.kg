<?php

namespace App\Models;

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
 * @property PriceType $price_type
 * @property string $phone
 * @property boolean $has_whatsapp
 * @property boolean $has_telegram
 * @property string $latitude
 * @property string $longitude
 * @property string $status
 * @property string $expires_at
 * @property int $views
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
        'price_type',
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
        'price_type'   => PriceType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
