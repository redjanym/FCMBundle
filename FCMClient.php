<?php

/*
 * This file is part of the FCMBundle.
 *
 * (c) Redjan Ymeraj <ymerajredjan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RedjanYm\FCMBundle;

use Psr\Http\Message\ResponseInterface;
use RedjanYm\FCM\ClientInterface;
use RedjanYm\FCM\Notification;

/**
 * @author Redjan Ymeraj <ymerajredjan@gmail.com>
 */
class FCMClient
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function sendNotification(Notification $notification): ResponseInterface
    {
        return $this->client->send($notification);
    }
}
