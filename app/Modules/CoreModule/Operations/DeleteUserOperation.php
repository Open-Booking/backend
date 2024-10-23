<?php

namespace App\Modules\CoreModule\Operations;

use App\Modules\CoreModule\Jobs\DeleteUserJob;
use App\Modules\CoreModule\Jobs\LogoutAllSessionsJob;
use App\Next\Core\Operation;

class DeleteUserOperation extends Operation
{
    public function __construct(private readonly int $userId)
    {
    }

    /**
     * Execute the operation.
     */
    public function handle()
    {
        $this->run(new LogoutAllSessionsJob($this->userId)); // first logout all user sessions

        return $this->run(new DeleteUserJob($this->userId)); // then, delete the user
    }
}
