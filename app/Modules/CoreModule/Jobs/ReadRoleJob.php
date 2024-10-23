<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\Role;
use App\Next\Core\Job;

class ReadRoleJob extends Job
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
        $data = Role::with('abilities')->findOrFail($this->roleId);

        return $data;
    }
}
