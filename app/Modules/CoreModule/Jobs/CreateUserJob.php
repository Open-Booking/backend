<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\User;
use App\Next\Core\Job;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateUserJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payload = collect($this->payload);
        $createPayload = $payload->except(['avatar'])->toArray();
        if ($payload->get('avatar') && $payload->get('avatar') instanceof UploadedFile) {
            $file = $payload->get('avatar');
            $filename = 'avatars/' . $payload->get('username') . time() . '.' . $file->extension();

            // Resize the image to add later

            Storage::putFileAs('public', $file, $filename);
            $createPayload['avatar'] = $filename;
        }
        $user = User::create($createPayload);

        return $user;
    }
}
