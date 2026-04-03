<?php

namespace RedjanYm\FCMBundle;

use RedjanYm\FCM\Notification;
use RedjanYm\FCM\Recipient\Device;
use RedjanYm\FCM\Recipient\Topic;

class NotificationFactory
{
    /**
     * Create a notification targeted at a specific device token.
     *
     * @param array<string, mixed> $data
     */
    public function createDeviceNotification(string $token, string $title, ?string $body = null, array $data = []): Notification
    {
        return new Notification(new Device($token), $title, $body, $data);
    }

    /**
     * Create a notification targeted at a topic.
     *
     * @param array<string, mixed> $data
     */
    public function createTopicNotification(string $topic, string $title, ?string $body = null, array $data = []): Notification
    {
        return new Notification(new Topic($topic), $title, $body, $data);
    }
}