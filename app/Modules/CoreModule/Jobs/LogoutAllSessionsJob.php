<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\User;
use App\Next\Core\Job;

class LogoutAllSessionsJob extends Job
{
    public function __construct(private readonly int $userId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->userId);
        $user->tokens()->delete();
    }
}
