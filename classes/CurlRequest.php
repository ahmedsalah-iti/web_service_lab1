<?php
class CurlRequest extends AbstractRequest
{
    
    public function send()
    {
        if (!$this->url){
            return;
        }
        $curl = curl_init($this->url);
        if($this->headers){
            curl_setopt($curl,CURLOPT_HEADER,$this->headers);
        }
        if ($this->method != 'GET'){
            if ($this->body){
                if ($this->isArrayBody){
                    curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($this->body));
                }else{
                    curl_setopt($curl,CURLOPT_POSTFIELDS,$this->body);
                }
            }
        }
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $this->response = curl_exec($curl);
        if (!curl_errno($curl)){
            $this->connected = true;
            $this->status_code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        }
        curl_close($curl);
    }
}