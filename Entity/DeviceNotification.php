<?php

namespace RedjanYm\FCMBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use sngrl\PhpFirebaseCloudMessaging\Notification;
use RedjanYm\FCMBundle\Model\DeviceNotificationInterface;

class DeviceNotification extends Notification implements DeviceNotificationInterface
{

    use NotificationData;

    /**
     * @var ArrayCollection $deviceToken
     */
    private $deviceTokens;

    public function __construct($title = '', $body = '')
    {
        parent::__construct($title, $body);

        $this->deviceTokens = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function setDeviceToken($token)
    {
        $this->deviceTokens[] = $token;

        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function addDeviceToken($token)
    {
        if(is_string($token) === false){
            throw new \InvalidArgumentException('Token must be a string!');
        }

        $this->deviceTokens->add($token);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDeviceTokens($tokens)
    {
        if(is_array($tokens) === false){
            throw new \InvalidArgumentException('Tokens must be an array of strings!');
        }

        $this->deviceTokens = new ArrayCollection($tokens);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDeviceToken()
    {
        if ($this->deviceTokens->isEmpty() === false) {
            return $this->deviceTokens->first();
        } else {
            throw new \InvalidArgumentException('The Mobile Notification must have a Device Token!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDeviceTokens()
    {
        if ($this->deviceTokens->isEmpty() === false) {
            return $this->deviceTokens->toArray();
        } else {
            throw new \InvalidArgumentException('The Mobile Notification must have a Device Token!');
        }
    }
}
