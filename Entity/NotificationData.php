<?php

namespace RedjanYm\FCMBundle\Entity;


trait NotificationData {

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var string
     */
    private $priority;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function addData($key, $value)
    {
        if((is_string($key) || is_numeric($key)) && strlen($key) > 0) {
            $this->data[$key] = $value;
        } else {
            throw new \InvalidArgumentException('The value of key must not be empty!');
        }

        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function removeData($key)
    {
        if(isset($this->data[$key])){
            unset($this->data[$key]);
        }

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
     * @return $this;
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }
}