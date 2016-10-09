Installation
============

Step 1: Download the Bundle
---------------------------

Execute the following command to download the latest stable version of this bundle:

```bash
$ composer require RedjanYm/fcm-bundle "^1.0"
```

This command requires you to have Composer installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new RedjanYm\FCMBundle\RedjanYmFCMBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Configuration
---------------------

On your `app/config.yml` file add this configuration and insert your Firebase API Key that you can generate in the Firebase Console.

```yaml
redjan_ym_fcm:
    firebase_api_key: sdadasdasdasdasd245sadas5d4a8sd2d5as4d8s
```


Step 4: Usage
-------------

* Get the FCM client from the container.

```php
$fcmClient = $this->getContainer()->get('redjan_ym_fcm.client');
```

* Create a Notification
For now FCMBundle supports only Device Notifications. Topic Notifications will be added in the future versions.

```
$notification = $fcmClient->createDeviceNotification(
        'Title of Notification', 
        'Body of Notification', 
        'Firebase Token of the device who will recive the notification'
    );
```
In case you need to send extra data or set other notification properties the Notification Entity suports a set of setters and getters like:
```
    $notification->setData($array); and $notification->getData();
    
    $notification->setPriority('high'); // Exepts 2 priorities, high(default) and low
    
    $notification->setIcon('name of icon located in the native mobile app');
```

And also modify use setters and getters for the arguments passed in the `createDeviceNotification` method.
```
    $notifiaction->setTitle('string');
    $notifiaction->setBody('text');
    $notifiaction->setDeviceToken('string');
```

**The only required field is the Device Token**

* Send notification
```
$fcmClient->sendNotification($notification);
```

The request of sending the notification is a Synchronous Request. 

**The Asynchronous requests will be implemented in the next version!**