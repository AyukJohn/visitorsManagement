<?php

namespace App\Notifications;

use LaraFirebase\Notifications\Notification;
//use Kutia\Larafirebase\Messages\FirebaseMessage;

class FirebasePushNotification extends Notification
{
    public function toFirebase($notifiable)
    {
        return [
            'title' => 'Notification Title',
            'body' => 'The body of your push notification.',
        ];
    }
}

