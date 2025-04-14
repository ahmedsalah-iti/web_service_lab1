<?php

abstract class AbstractRequest
{
    protected $url;
    protected $method;
    protected $headers;
    protected $body;
    protected $isArrayBody;
    protected $connected;
    protected $status_code;
    protected $response;

    public function __construct($url, $method = 'GET', $headers = array(), $body = null, $isArrayBody = false)
    {
        $this->url = $url;
        $this->method = $method;
        $this->headers = $headers;
        $this->body = $body;
        $this->isArrayBody = $isArrayBody;
        $this->status_code = 0;
        $this->response = null;
        $this->connected = false;
    }

    abstract public function send();

    public function isSent()
    {
        return $this->connected;
    }

    public function getCode()
    {
        return intval($this->status_code);
    }

    public function getResponse()
    {
        return $this->response;
    }
}