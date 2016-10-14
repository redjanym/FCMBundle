<?php

namespace RedjanYm\FCMBundle\Model;

interface DeviceNotification
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
