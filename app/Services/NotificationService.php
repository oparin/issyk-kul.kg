<?php

namespace App\Services;

use App\Models\Notification;
use App\Channels\EmailChannel;
use App\Channels\SmsChannel;
use App\Channels\TelegramChannel;

class NotificationService
{
    public function sendNotification(int $userId, string $content, string $channel): void
    {
        $notification = Notification::query()->create([
            'user_id' => $userId,
            'content' => $content,
            'channel' => $channel,
            'status' => Notification::STATUS_PENDING,
        ]);
        
        try {
            switch ($channel) {
                case 'email':
                    $this->sendEmail($userId, $content);
                    break;
                case 'sms':
                    $this->sendSms($userId, $content);
                    break;
                case 'telegram':
                    $this->sendTelegram($userId, $content);
                    break;
                default:
                    throw new \Exception("Unsupported notification channel");
            }
            
            $notification->status = Notification::STATUS_SENT;
        } catch (\Exception $e) {
            $notification->status = Notification::STATUS_ERROR;
        }
        
        $notification->save();
    }
    
    private function sendEmail(int $userId, string $content): void
    {
        \Mail::to(User::find($userId)->email)->send(new \App\Mail\NotificationMail($content));
    }
    
    private function sendSms(int $userId, string $content): void
    {
        // SmsService::send(User::find($userId)->phone, $content);
    }
    
    private function sendTelegram(int $userId, string $content): void
    {
        // TelegramService::send(User::find($userId)->telegram_id, $content);
    }

    public function queueNotification(int $userId, string $content, string $channel): void
    {
        \Queue::push(new \App\Jobs\SendNotificationJob($userId, $content, $channel));
    }
}
