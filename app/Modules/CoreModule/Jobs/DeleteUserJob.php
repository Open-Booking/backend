<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\User;
use App\Next\Core\Job;
use Illuminate\Support\Facades\Storage;

class DeleteUserJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        $user = User::findOrFail($this->userId);
        if ($user->avatar) {
            $file = 'public/' . $user->getAttributes()['avatar'];
            Storage::exists($file) ? Storage::delete($file) : null;
        }

        return $user->delete();
    }
}
