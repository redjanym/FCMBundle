<?php
/**
 * @author Redjan Ymeraj <ymerajr@yahoo.com>
 */

namespace RedjanYm\FCMBundle;


use RedjanYm\FCMBundle\Entity\DeviceNotification;
use RedjanYm\FCMBundle\Entity\TopicNotification;
use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Topic;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FCMClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * FCMClient constructor.
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
     * @return Client
     */
    public function sendNotification($notification)
    {
        if (!$notification instanceof DeviceNotification) {
            throw new NotFoundHttpException("Notification must be of type DeviceNotification");
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