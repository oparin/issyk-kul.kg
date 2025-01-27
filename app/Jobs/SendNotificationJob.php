<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNotificationJob implements ShouldQueue
{
    use Queueable;

    protected User   $user;
    protected string $content;
    protected string $channel;
    
    public function __construct(User $user, string $content, string $channel)
    {
        $this->user    = $user;
        $this->content = $content;
        $this->channel = $channel;
    }
    
    public function handle(NotificationService $notificationService): void
    {
        $notificationService->sendNotification($this->user, $this->content, $this->channel);
    }
}
