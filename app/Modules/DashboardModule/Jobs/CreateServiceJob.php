<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Service;
use App\Next\Core\Job;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateServiceJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payload = collect($this->payload);
        $createPayload = $payload->except(['image'])->toArray();
        if ($payload->get('image') && $payload->get('image') instanceof UploadedFile) {
            $file = $payload->get('image');
            $name = $payload['name']['en'];
            $name = str_replace(' ', '-', $name);
            $filename = 'services/' . $name . time() . '.' . $file->extension();

            // Resize the image to add later

            Storage::putFileAs('public', $file, $filename);
            $createPayload['image'] = $filename;
        }
        $service = Service::create($createPayload);

        return $service;
    }
}
