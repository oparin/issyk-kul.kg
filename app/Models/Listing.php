<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property string $status
 * @property string $expires_at
 * @property int $views
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
        'status',
        'expires_at',
        'views',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
