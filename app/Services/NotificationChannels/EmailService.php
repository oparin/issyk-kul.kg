<?php

namespace App\Services\NotificationChannels;

use App\Mail\NotificationMail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailService implements ChannelInterface
{
    
    public static function send(User $user, string $content): void
    {
        try {
            Mail::to($user->email)->send(new NotificationMail($content));
        } catch (Exception $e) {
            Log::error('Error send email: ' . $e->getMessage());
        }
    }
}
