<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $channel
 * @property string $content
 * @property string $status
 * @property User $user
 */
class Notification extends Model
{
    use HasFactory;
    
    const STATUS_PENDING = 'pending';
    const STATUS_SENT    = 'sent';
    const STATUS_ERROR   = 'error';
    
    protected $table = 'notifications';
    
    protected $fillable = [
        'user_id',
        'channel',
        'content',
        'status',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
