<?php

namespace App\Modules\CoreModule\Http\Controllers;

use App\Modules\CoreModule\Features\CreateRoleFeature;
use App\Modules\CoreModule\Features\DeleteRoleFeature;
use App\Modules\CoreModule\Features\IndexRoleFeature;
use App\Modules\CoreModule\Features\ReadRoleFeature;
use App\Modules\CoreModule\Features\UpdateRoleFeature;
use App\Next\Core\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexRoleFeature());
    }

    public function create()
    {
        return $this->serve(new CreateRoleFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadRoleFeature($id));
    }

    public function update($id)
    {
        return $this->serve(new UpdateRoleFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeleteRoleFeature($id));
    }
}
