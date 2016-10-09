<?php
/**
 * @author Redjan Ymeraj <ymerajr@yahoo.com>
 */

namespace RedjanYm\FCMBundle\Entity;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class DeviceNotification extends Notification implements \RedjanYm\FCMBundle\Model\DeviceNotification
{
    private $deviceToken;

    /**
     * @inheritdoc
     * @param string $token
     */
    public function setDeviceToken($token)
    {
        $this->deviceToken = $token;
        return $this;
    }

    /**
     * @inheritdoc
     * @return mixed
     */
    public function getDeviceToken()
    {
        if( $this->deviceToken ){
            return $this->deviceToken;
        } else {
            throw new InvalidArgumentException("The Mobile Notification must have a Device Token!");
        }
    }
}