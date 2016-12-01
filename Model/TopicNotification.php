<?php

namespace RedjanYm\FCMBundle\Model;

interface TopicNotification
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
