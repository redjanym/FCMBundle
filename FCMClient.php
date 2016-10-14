<?php

/*
 * This file is part of the FCMBundle.
 *
 * (c) Redjan Ymeraj <ymerajr@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RedjanYm\FCMBundle;

use RedjanYm\FCMBundle\Entity\DeviceNotification;
use RedjanYm\FCMBundle\Entity\TopicNotification;
use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * The FCMBundle primary class.
 *
 * @author Redjan Ymeraj <ymerajr@yahoo.com>
 */
class FCMClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * FCMClient constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createDeviceNotification($title = null, $body = null, $token = null)
    {
        $notification = new DeviceNotification();
        $notification
            ->setTitle($title)
            ->setBody($body)
            ->setDeviceToken($token);

        return $notification;
    }

    /**
     * @param DeviceNotification | TopicNotification $notification
     *
     * @return Client
     */
    public function sendNotification($notification)
    {
        if (!$notification instanceof DeviceNotification) {
            throw new NotFoundHttpException('Notification must be of type DeviceNotification');
        }
        $this->client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

        $message = new Message();
        $message->setPriority($notification->getPriority());

        $message->addRecipient(new Device($notification->getDeviceToken()));

        $message
            ->setNotification(
                new Notification(
                    $notification->getTitle(),
                    $notification->getBody()
                )
            )
            ->setData($notification->getData());

        return $this->client->send($message);
    }
}
