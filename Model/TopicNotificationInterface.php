<?php

namespace RedjanYm\FCMBundle\Model;

interface TopicNotificationInterface
{
    /**
     * @param string $topic
     *
     * @return TopicNotification
     */
    public function setTopic($topic);

    /**
     * @return string
     */
    public function getTopic();
}
