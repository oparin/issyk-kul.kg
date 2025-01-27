<?php

namespace App\Services;

use App\Jobs\SendNotificationJob;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationChannels\EmailService;
use App\Services\NotificationChannels\SmsService;
use App\Services\NotificationChannels\PushService;
use App\Services\NotificationChannels\WhatsAppService;
use App\Services\NotificationChannels\TelegramService;

class NotificationService
{
    public function sendNotification(User $user, string $content, string $channel): void
    {
        $notification = Notification::query()->create([
            'user_id' => $user->id,
            'content' => $content,
            'channel' => $channel,
            'status'  => Notification::STATUS_PENDING,
        ]);
        
        try {
            switch ($channel) {
                case 'email':
                    $this->sendEmail($user, $content);
                    break;
                case 'sms':
                    $this->sendSms($user, $content);
                    break;
                case 'push':
                    $this->sendPush($user, $content);
                    break;
                case 'whatsapp':
                    $this->sendWhatsApp($user, $content);
                    break;
                case 'telegram':
                    $this->sendTelegram($user, $content);
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
    
    private function sendEmail(User $user, string $content): void
    {
        EmailService::send($user, $content);
    }
    
    private function sendSms(User $user, string $content): void
    {
         SmsService::send($user, $content);
    }
    
    private function sendPush(User $user, string $content): void
    {
         PushService::send($user, $content);
    }
    
    private function sendWhatsApp(User $user, string $content): void
    {
         WhatsAppService::send($user, $content);
    }
    
    private function sendTelegram(User $user, string $content): void
    {
         TelegramService::send($user, $content);
    }
    
    public function queueNotification(User $user, string $content, string $channel): void
    {
        SendNotificationJob::dispatch($user, $content, $channel);
    }
}
