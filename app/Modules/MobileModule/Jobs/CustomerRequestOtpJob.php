<?php

namespace App\Modules\MobileModule\Jobs;

use App\Helpers\OTP;
use App\Next\Core\Job;

class CustomerRequestOtpJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $channel, private array $payload)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->validateChannel();
        switch ($this->channel) {
            case 'email': (new OTP($this->payload['email']))->sendViaEmail();
                break;
            case 'sms': (new OTP($this->payload['mobile_number']))->sendViaSMS();
        }
    }

    public function validateChannel()
    {
        if (!collect(['email', 'sms'])->contains($this->channel)) {
            $class = get_class($this);
            throw new \Exception("Channel $this->channel is not available in $class");
        }
    }
}
