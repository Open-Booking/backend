<?php

namespace App\Modules\CoreModule\Http\Controllers;

use App\Modules\CoreModule\Features\CreateUserFeature;
use App\Modules\CoreModule\Features\DeleteUserFeature;
use App\Modules\CoreModule\Features\GetProfileFeature;
use App\Modules\CoreModule\Features\IndexUserFeature;
use App\Modules\CoreModule\Features\ReadUserFeature;
use App\Modules\CoreModule\Features\UpdateProfileFeature;
use App\Modules\CoreModule\Features\UpdateUserFeature;
use App\Next\Core\Controller;

class UserController extends Controller
{
    /**
     * Show Authenticated User Information.
     */
    public function getProfile()
    {
        return $this->serve(new GetProfileFeature());
    }

    /**
     * Update Authenticated User Profile Information.
     */
    public function updateProfile()
    {
        return $this->serve(new UpdateProfileFeature());
    }

    public function index()
    {
        return $this->serve(new IndexUserFeature());
    }

    public function create()
    {
        return $this->serve(new CreateUserFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadUserFeature($id));
    }

    public function update($id)
    {
        return $this->serve(new UpdateUserFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeleteUserFeature($id));
    }
}
