<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\Role;
use App\Next\Core\Job;

class DeleteRoleJob extends Job
{
    public function __construct(private readonly int $roleId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $role = Role::with('abilities')->findOrFail($this->roleId);
        $role->abilities()->detach();

        return $role->delete();
    }
}
