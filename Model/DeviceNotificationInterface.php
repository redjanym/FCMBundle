<?php

namespace RedjanYm\FCMBundle\Model;

interface DeviceNotificationInterface
{
    /**
     * @param string $token
     *
     * @return DeviceNotification
     */
    public function setDeviceToken($token);

    /**
     * @return string
     */
    public function getDeviceToken();
}
