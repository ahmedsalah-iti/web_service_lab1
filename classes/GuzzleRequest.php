<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleRequest extends AbstractRequest
{

    public function send()
    {
        if (!$this->url) {
            return;
        }

        $client = new Client();
        $options = [];

        if (!empty($this->headers)) {
            $options['headers'] = $this->headers;
        }

        if ($this->method !== 'GET' && $this->body !== null) {
            if ($this->isArrayBody) {
                $options['json'] = $this->body;
            } else {
                $options['body'] = $this->body;
            }
        }

        try {
            $res = $client->request($this->method, $this->url, $options);
            $this->connected = true;
            $this->status_code = $res->getStatusCode();
            $this->response = $res->getBody()->getContents();
        } catch (RequestException $e) {
            $this->connected = false;
        }
    }

}
