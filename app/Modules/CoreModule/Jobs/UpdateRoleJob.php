<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\Role;
use App\Next\Core\Job;

class UpdateRoleJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload, private readonly int $roleId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $role = Role::findOrFail($this->roleId);
        $payload = collect($this->payload);
        $updatePayload = $payload->except(['ability_ids'])->toArray();

        $role->update($updatePayload);
        $role->abilities()->sync($payload->get('ability_ids'));

        return $role;
    }
}
