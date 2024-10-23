<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\User;
use App\Next\Core\Job;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateUserJob extends Job
{
    public function __construct(private array $payload, private readonly int $userId)
    {
    }

    /**
     * Execute the job.
     *
     * @return User
     */
    public function handle()
    {
        $payload = collect($this->payload);
        $updatePayload = $payload->except(['avatar', 'avatar_updated'])->toArray();

        $user = User::findOrFail($this->userId);
        $avatarUpdated = filter_var($payload->get('avatar_updated'), FILTER_VALIDATE_BOOLEAN);
        if ($avatarUpdated) {
            if ($user->getAttributes()['avatar']) {
                // deleting old avatar file
                $old_file = '/public/' . $user->getAttributes()['avatar'];
                Storage::exists($old_file) ? Storage::delete($old_file) : null;
            }
            if ($payload->get('avatar') && $payload->get('avatar') instanceof UploadedFile) {
                $file = $payload->get('avatar');
                $filename = 'avatars/' . $user->username . time() . '.' . $file->extension();

                // Resize the image to add later

                Storage::putFileAs('public', $file, $filename);
                $updatePayload['avatar'] = $filename;
            }
        }

        $user->update($updatePayload);

        return $user;
    }
}
