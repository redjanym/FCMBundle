<?php

namespace RedjanYm\FCMBundle\Tests;

use PHPUnit\Framework\TestCase;
use RedjanYm\FCM\Notification;
use RedjanYm\FCM\Recipient\Device;
use RedjanYm\FCM\Recipient\Topic;
use RedjanYm\FCMBundle\NotificationFactory;

class NotificationFactoryTest extends TestCase
{
    private NotificationFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new NotificationFactory();
    }

    public function testCreateDeviceNotification(): void
    {
        $notification = $this->factory->createDeviceNotification(
            'device-token-123',
            'Test Title',
            'Test Body',
            ['key' => 'value']
        );

        $this->assertInstanceOf(Notification::class, $notification);
        $this->assertInstanceOf(Device::class, $notification->recipient);
        $this->assertSame('device-token-123', $notification->recipient->getTarget());
        $this->assertSame('token', $notification->recipient->getType());
        $this->assertSame('Test Title', $notification->title);
        $this->assertSame('Test Body', $notification->body);
        $this->assertSame(['key' => 'value'], $notification->data);
    }

    public function testCreateDeviceNotificationWithMinimalArgs(): void
    {
        $notification = $this->factory->createDeviceNotification('token-abc', 'Title Only');

        $this->assertSame('token-abc', $notification->recipient->getTarget());
        $this->assertSame('Title Only', $notification->title);
        $this->assertNull($notification->body);
        $this->assertSame([], $notification->data);
    }

    public function testCreateTopicNotification(): void
    {
        $notification = $this->factory->createTopicNotification(
            'news',
            'Breaking News',
            'Something happened',
            ['url' => 'https://example.com']
        );

        $this->assertInstanceOf(Notification::class, $notification);
        $this->assertInstanceOf(Topic::class, $notification->recipient);
        $this->assertSame('news', $notification->recipient->getTarget());
        $this->assertSame('topic', $notification->recipient->getType());
        $this->assertSame('Breaking News', $notification->title);
        $this->assertSame('Something happened', $notification->body);
        $this->assertSame(['url' => 'https://example.com'], $notification->data);
    }

    public function testCreateTopicNotificationWithMinimalArgs(): void
    {
        $notification = $this->factory->createTopicNotification('alerts', 'Alert');

        $this->assertSame('alerts', $notification->recipient->getTarget());
        $this->assertSame('Alert', $notification->title);
        $this->assertNull($notification->body);
        $this->assertSame([], $notification->data);
    }

    public function testTopicNotificationSerializesWithTopicKey(): void
    {
        $notification = $this->factory->createTopicNotification('news', 'Title', 'Body');
        $json = $notification->jsonSerialize();

        $this->assertArrayHasKey('topic', $json);
        $this->assertSame('news', $json['topic']);
        $this->assertArrayNotHasKey('token', $json);
    }

    public function testDeviceNotificationSerializesWithTokenKey(): void
    {
        $notification = $this->factory->createDeviceNotification('abc123', 'Title', 'Body');
        $json = $notification->jsonSerialize();

        $this->assertArrayHasKey('token', $json);
        $this->assertSame('abc123', $json['token']);
        $this->assertArrayNotHasKey('topic', $json);
    }
}
