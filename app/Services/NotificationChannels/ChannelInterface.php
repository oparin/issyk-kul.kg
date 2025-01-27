<?php

namespace App\Services\NotificationChannels;

use App\Models\User;

interface ChannelInterface
{
    public static function send(User $user, string $content);
}
