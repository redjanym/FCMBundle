<?php

namespace RedjanYm\FCMBundle;

use RedjanYm\FCM\Notification;
use RedjanYm\FCM\Recipient\Device;
use RedjanYm\FCM\Recipient\Topic;

class NotificationFactory
{
    /**
     * Create a notification targeted at a specific device token.
     */
    public function createDeviceNotification(string $token, string $title, ?string $body = null, array $data = []): Notification
    {
        return new Notification(new Device($token), $title, $body, $data);
    }

    /**
     * Create a notification targeted at a topic.
     */
    public function createTopicNotification(string $topic, string $title, ?string $body = null, array $data = []): Notification
    {
        return new Notification(new Topic($topic), $title, $body, $data);
    }
}