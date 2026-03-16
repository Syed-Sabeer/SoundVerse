<?php

namespace App\Providers;

use App\Events\NotificationEvent;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('notificationService', function () {
            return new class {
                public function notifyUsers($users, $message, $title = null, $type = null, $actionUrl = null, $metadata = null)
                {
                    foreach ($users as $user) {
                        $notification = Notification::create([
                            'user_id' => $user->id,
                            'message' => $message,
                            'title'   => $title,
                            'type'    => $type,
                            'notification_type' => 'in_app',
                            'action_url' => $actionUrl,
                            'metadata' => $metadata ? (is_array($metadata) ? $metadata : json_decode($metadata, true)) : null,
                            'is_read' => false,
                            'sent_at' => now(),
                        ]);
                        broadcast(new NotificationEvent($notification));
                    }
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
