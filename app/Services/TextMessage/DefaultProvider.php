<?php

namespace App\Services\TextMessage;

use GuzzleHttp\Client;
use App\Models\SmsSetup;

class DefaultProvider
{
    /**
     * Guzzle HTTP client
     *
     * @var Client
     */
    private $client;

    /**
     * SMS provider config
     *
     * @var config
     */
    private $config;
    
        
    public function __construct()
    {
        $this->config = SmsSetup::find(1);
        
        $this->client = new Client([
            'base_uri' => $this->config->base_uri,            
            'http_errors' => false,
        ]);
    }

    /**
     * Parse the response
     *
     * @param string $mobileNumber
     * @param string $message
     *
     * @return array
     */
    public function send(string $mobileNumber,string $message) //: array
    {
        return $this->client->get('', [
            'query' => [
                'masking' => $this->config->masking,
                'userName' => $this->config->username,
                'password' => $this->config->token,
                'MsgType' => $this->config->msg_type,
                'receiver' => $mobileNumber,
                'message' => $message,
            ],
        ]);
    }
    /**
     * Parse the response
     *
     * @param string $mobileNumber
     * @param string $message
     *
     * @return array
     */
    public function sendOtp(string $mobileNumber,string $otp) //: array
    {
        $vars = array(
            '{OTP}' =>  $otp,
        );
        $smsText = strtr($this->config->msg_template,$vars);      
          
        return $this->send($mobileNumber,$smsText);        
    }


    public function sendSMS(string $mobileNumber,string $smsText) //: array
    {
        return $this->send($mobileNumber,$smsText);        
    }

}