<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\UserStatusEnum;
use App\Helpers\OTP;
use App\Models\Customer;
use App\Next\Core\Job;

class CustomerRegisterJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload)
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
        $payload = collect($this->payload);

        $mobile_number = $payload['mobile_number'];

        $otp = $payload['otp'];


        //temporary skipping otp check if not env is not production
        // if (config('app.env') == 'production') {
        //     $is_valid = OTP::verify($mobile_number, $otp);
        //     if (!$is_valid) {
        //         return [false, null, 'OTP is invalid!'];
        //     }
        // }


        $is_valid = OTP::verify($mobile_number, $otp);
        if (!$is_valid) {
            return [false, null];
        }

        $payload['status'] = UserStatusEnum::ACTIVE->value;

        $createPayload = $payload->except(['otp'])->toArray();
        $customer = Customer::create($createPayload);

        $authCustomer = Customer::find($customer->id);
        $jwtToken = auth()->guard('customer')->login($authCustomer);

        $customerData = Customer::with('area')->find($customer->id);

        // forget the cache otp value after successful login one time.
        OTP::forget($mobile_number);

        return [true, [
            'access_token' => $jwtToken,
            'user_data' => $customerData,
        ]];

    }
}
