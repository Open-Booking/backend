<?php

namespace App\Helpers;

// use App\Jobs\SendSMSJob;

use App\Jobs\SendSMSJob;
use App\Mail\SendOTP;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class OTP
{
    private string $cachePrefix = 'otp_';

    public string $otp;

    private string $recipient;

    private int $ttl;

    public function __construct($recipient, $ttl = 300)
    {
        $this->recipient = $recipient;
        $this->ttl = $ttl;

        $this->generateForRecipient();
    }

    public function generateForRecipient(): void
    {
        //TODO Control ttl from application settings later
        $this->otp = config('app.env') == 'development' ? '111111' : NumberHelper::getRandomNumber();

        $cacheKey = $this->cachePrefix . $this->recipient;
        Cache::put($cacheKey, $this->otp, $this->ttl);
    }

    public function sendViaEmail(): void
    {
        Mail::to($this->recipient)->queue((new SendOTP($this->otp))->onQueue('send_otp'));
    }

    public function sendViaSMS($message = null, $sender = null, $provider = 'smspoh'): void
    {
        /** $provider 'smspoh' or 'otpsms'
         * default sms provider is 'smspoh'. */
        $appName = config('app.name');
        if (!$message) {
            $message = "Your OTP for $appName is: $this->otp. Please do not share this code with anyone.";
        }

        if (config('app.env') != 'development') {
            /*
             * send SMS using Queue Job
             * send_otp queue
             * */
            SendSMSJob::dispatch($this->recipient, $message, $sender, $provider)->onQueue('send_otp');
        }
    }

    public static function verify($recipient, $otp): bool
    {
        $cacheKey = 'otp_' . $recipient;

        return Cache::get($cacheKey) == $otp;
    }

    public static function forget($recipient): bool
    {
        $cacheKey = 'otp_' . $recipient;

        return Cache::forget($cacheKey);
    }
}
