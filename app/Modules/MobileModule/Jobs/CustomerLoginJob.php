<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\UserStatusEnum;
use App\Helpers\OTP;
use App\Models\Customer;
use App\Next\Core\Job;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerLoginJob extends Job
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
        try {
            $customer = Customer::with('area')
                ->where('status', UserStatusEnum::ACTIVE->value)
                ->where('mobile_number', $this->payload['identifier'])
                ->firstOrFail();
        } catch (ModelNotFoundException $_) {
            return [false, null, 'User account is not found'];
        }

        $mobile_number = $this->payload['identifier'];
        $otp = $this->payload['password'];

        // Temporarily added Code for play store submission demo account
        if ($mobile_number !== '09799572499') {
            $is_valid = OTP::verify($mobile_number, $otp);
            if (!$is_valid) {
                return [false, null, 'OTP is invalid!'];
            }
        }

        // after play store submission this code will be used
        // $is_valid = OTP::verify($mobile_number, $otp);
        // if (!$is_valid) {
        //     return [false, null, 'OTP is invalid!'];
        // }

        $authCustomer = Customer::find($customer->id);
        $jwtToken = auth()->guard('customer')->login($authCustomer);

        // forget the cache otp value after successful login one time.
        OTP::forget($mobile_number);

        return [true, [
            'access_token' => $jwtToken,
            'user_data' => $customer,
        ], 'Logged in successfully!'];

    }
}
