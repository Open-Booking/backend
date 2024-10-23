<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Service;
use App\Next\Core\Job;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateServiceJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload, private readonly int $serviceId)
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
        $updatePayload = $payload->except(['image', 'image_updated'])->toArray();

        $service = Service::findOrFail($this->serviceId);
        $imageUpdated = filter_var($payload->get('image_updated'), FILTER_VALIDATE_BOOLEAN);
        if ($imageUpdated) {
            if ($service->getAttributes()['image']) {
                // deleting old image file
                $oldFile = '/public/' . $service->getAttributes()['image'];
                Storage::exists($oldFile) ? Storage::delete($oldFile) : null;
            }
            if ($payload->get('image') && $payload->get('image') instanceof UploadedFile) {
                $file = $payload->get('image');
                $name = $payload['name']['en'];
                $name = str_replace(' ', '-', $name);
                $filename = 'services/' . $name . time() . '.' . $file->extension();

                // Resize the image to add later

                Storage::putFileAs('public', $file, $filename);
                $updatePayload['image'] = $filename;
            }
        }

        $service->update($updatePayload);

        return $service;
    }
}
