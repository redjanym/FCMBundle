## FCMBundle

A Symfony Bundle for sending push notifications to mobile devices (Android, iOS) and web browsers via Google's **Firebase Cloud Messaging HTTP V1 API**.

### Requirements

- PHP >= 7.4
- Symfony 5.4 / 6.x / 7.x

### Installation

```bash
composer require redjanym/fcm-bundle
```

### Configuration

Add your Firebase service account JSON file path to your Symfony configuration:

```yaml
# config/packages/redjan_ym_fcm.yaml
redjan_ym_fcm:
    service_account_file: '%kernel.project_dir%/config/firebase/service-account.json'
```

You can download the service account file from the [Firebase Console](https://console.firebase.google.com/) under **Project Settings > Service accounts > Generate new private key**.

### Usage

#### Sending to a Device

```php
use RedjanYm\FCM\Notification;
use RedjanYm\FCM\Recipient\Device;

// Using the notification factory (recommended)
$factory = $this->container->get('redjan_ym_fcm.notification_factory');
$notification = $factory->createDeviceNotification(
    'device-token-here',
    'Notification Title',
    'Notification Body',
    ['key' => 'value']  // optional data payload
);

// Or manually
$notification = new Notification(
    new Device('device-token-here'),
    'Notification Title',
    'Notification Body'
);

// Send
$client = $this->container->get('redjan_ym_fcm.client');
$response = $client->send($notification);
```

#### Sending to a Topic

Send notifications to all devices subscribed to a topic:

```php
use RedjanYm\FCM\Notification;
use RedjanYm\FCM\Recipient\Topic;

// Using the notification factory (recommended)
$factory = $this->container->get('redjan_ym_fcm.notification_factory');
$notification = $factory->createTopicNotification(
    'news',
    'Breaking News',
    'Something important happened',
    ['url' => 'https://example.com/article/123']
);

// Or manually
$notification = new Notification(
    new Topic('news'),
    'Breaking News',
    'Something important happened'
);

// Send
$client = $this->container->get('redjan_ym_fcm.client');
$response = $client->send($notification);
```

#### Customizing Notifications

The `Notification` object exposes public properties for platform-specific settings:

```php
$notification->image = 'https://example.com/image.png';
$notification->sound = 'default';
$notification->badge = 1;
$notification->icon = 'ic_notification';
$notification->color = '#FF0000';
$notification->clickAction = 'OPEN_ACTIVITY';
$notification->androidChannelId = 'my_channel';
$notification->androidPriority = 'high';
$notification->apnsPriority = '10';
$notification->ttl = '3600s';
$notification->analyticsLabel = 'campaign_123';

// Extra settings arrays for platform-specific customization
$notification->extraNotificationSettings = ['tag' => 'my-tag'];
$notification->extraAPNSHeadersSettings = ['apns-collapse-id' => 'campaign'];
$notification->webPushHeadersSettings = ['TTL' => '86400'];
```

### Available Services

| Service ID | Class | Description |
|---|---|---|
| `redjan_ym_fcm.client` | `RedjanYm\FCM\Client` | FCM HTTP V1 API client |
| `redjan_ym_fcm.notification_factory` | `RedjanYm\FCMBundle\NotificationFactory` | Factory for creating device and topic notifications |

### Running Tests

```bash
composer install
vendor/bin/phpunit
```

### License

MIT
