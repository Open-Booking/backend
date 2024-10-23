<?php

namespace App\Modules\MobileModule\Http\Controllers;

use App\Modules\MobileModule\Features\CustomerAppKeyFeature;
use App\Modules\MobileModule\Features\CustomerLoginFeature;
use App\Modules\MobileModule\Features\CustomerLogoutFeature;
use App\Modules\MobileModule\Features\CustomerRegisterFeature;
use App\Modules\MobileModule\Features\CustomerRequestOtpFeature;
use App\Modules\MobileModule\Features\DeleteProfileFeature;
use App\Modules\MobileModule\Features\GetProfileFeature;
use App\Modules\MobileModule\Features\UpdateProfileFeature;
use App\Next\Core\Controller;

class CustomerController extends Controller
{
    public function appKey()
    {
        /* When mobile app register screen or login screen is loaded, call to this endpoint to get app-key.
         * Save app-key in Cache.
         * When customer register or login, check app-key is included and valid.
         * Not implemented yet!
         * */
        return $this->serve(new CustomerAppKeyFeature());
    }

    public function requestOtp($channel)
    {
        return $this->serve(new CustomerRequestOtpFeature($channel));
    }

    public function register()
    {
        return $this->serve(new CustomerRegisterFeature());
    }

    public function login()
    {
        return $this->serve(new CustomerLoginFeature());
    }

    public function logout()
    {
        return $this->serve(new CustomerLogoutFeature());
    }

    public function getProfile()
    {
        return $this->serve(new GetProfileFeature());
    }

    /**
     * Update Authenticated Customer Profile Information.
     */
    public function updateProfile()
    {
        return $this->serve(new UpdateProfileFeature());
    }

    /**
     * Delete Authenticated Customer Profile Information.
     */
    public function deleteProfile()
    {
        return $this->serve(new DeleteProfileFeature());
    }
}
