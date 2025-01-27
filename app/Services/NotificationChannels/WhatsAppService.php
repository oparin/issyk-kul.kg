<?php

namespace App\Services\NotificationChannels;

use App\Models\User;

class WhatsAppService implements ChannelInterface
{
    
    public static function send(User $user, string $content)
    {
        // TODO: Implement send() method.
    }
}
