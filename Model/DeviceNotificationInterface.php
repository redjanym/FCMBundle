<?php

namespace RedjanYm\FCMBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use RedjanYm\FCMBundle\Entity\DeviceNotification;

interface DeviceNotificationInterface
{
    /**
     * @deprecated 1.1.2
     * @param string $token
     * @return DeviceNotification
     */
    public function setDeviceToken($token);

    /**
     * @param array $token
     * @return DeviceNotification
     */
    public function setDeviceTokens($token);

    /**
     * @param string $token
     * @return DeviceNotification
     */
    public function addDeviceToken($token);

    /**
     * @deprecated 1.1.2
     * @return string
     */
    public function getDeviceToken();

    /**
     * @return ArrayCollection
     */
    public function getDeviceTokens();
}
