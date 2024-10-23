<?php

namespace App\Helpers;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class SMS
{
    private string $driver;

    private \GuzzleHttp\Client $httpClient;

    /**
     * @throws Exception
     */
    public function __construct($driver = null)
    {
        $this->setDriver($driver);
        $this->httpClient = new \GuzzleHttp\Client();
    }

    /**
     * @throws Exception
     */
    private function setDriver($driver): void
    {
        if ($driver) {
            if (collect(config('sms.drivers'))->contains($driver)) {
                throw new Exception("Driver for sms, $driver is not currently supported.");
            }
            $this->driver = $driver;
        } else {
            $this->driver = config('sms.default');
        }
    }

    /**
     * @throws GuzzleException
     */
    public function sendViaSMS($to, $message, $sender = null)
    {
        switch ($this->driver) {
            case 'smspoh': $this->sendBySMSPOH($to, $message, $sender);
                break;
            case 'otpsms': $this->sendByOTPSMS($to, $message);
                break;
        }
    }

    public function sendBySMSPOH($to, $message, $sender)
    {
        $baseUrl = config("sms.drivers.$this->driver.base_url");
        $token = config("sms.drivers.$this->driver.token");
        $sender = config('sms.sender');

        try {
            $response = $this->httpClient
                ->request('POST', "$baseUrl/send", [
                    'headers' => [
                        'Authorization' => "Bearer $token",
                    ],
                    'json' => [
                        'to' => $to,
                        'message' => $message,
                        'sender' => $sender,
                    ],
                ]);

            return json_decode($response->getBody()->read(1024));
        } catch (GuzzleException $exception) {
            if ($exception->getCode() === 401) {
                info('Unauthorized to send SMS via SMSPOH, please check your smspoh token');
            }
            throw $exception;
        }
    }

    public function sendByOTPSMS($to, $message)
    {
        $baseUrl = config("sms.drivers.$this->driver.base_url");
        $appId = config("sms.drivers.$this->driver.app_id");
        $appSecret = config("sms.drivers.$this->driver.app_secret");

        $strValue = $to . $appId;
        $hashValue = hash_hmac('sha256', $strValue, $appSecret);

        try {
            $response = $this->httpClient
                ->request('POST', "$baseUrl/custom-sms", [
                    'headers' => [

                    ],
                    'json' => [
                        'phone_no' => $to,
                        'message' => $message,
                        'app_id' => $appId,
                        'hash' => $hashValue,
                    ],
                ]);

            return json_decode($response->getBody()->read(1024));
        } catch (GuzzleException $exception) {
            if ($exception->getCode() === 401) {
                info('Unauthorized to send SMS via OTPSMS, please check your credentials');
            }
            throw $exception;
        }
    }
}
