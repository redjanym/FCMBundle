<?php


namespace RedjanYm\FCMBundle\Entity;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Notification
{
    private $title;

    private $body;

    private $priority;

    private $icon;

    private $data;

    public function __construct()
    {
        $this->priority = 'high';
        $this->data     = array();
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     *
     * @return Notification
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param null $body
     *
     * @return Notification
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     *
     * @return Notification
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return Notification
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        if( $this->icon ){
            return $this->icon;
        } else {
            throw new NotFoundHttpException("The Mobile Notification must have a Icon!");
        }
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
}