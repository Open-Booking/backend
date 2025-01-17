<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Package;
use App\Next\Core\Job;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdatePackageJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload, private readonly int $packageId)
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

        $package = Package::findOrFail($this->packageId);
        $imageUpdated = filter_var($payload->get('image_updated'), FILTER_VALIDATE_BOOLEAN);
        if ($imageUpdated) {
            if ($package->getAttributes()['image']) {
                // deleting old image file
                $oldFile = '/public/' . $package->getAttributes()['image'];
                Storage::exists($oldFile) ? Storage::delete($oldFile) : null;
            }
            if ($payload->get('image') && $payload->get('image') instanceof UploadedFile) {
                $file = $payload->get('image');
                $name = $payload['name']['en'];
                $name = str_replace(' ', '-', $name);
                $filename = 'packages/' . $name . time() . '.' . $file->extension();

                // Resize the image to add later

                Storage::putFileAs('public', $file, $filename);
                $updatePayload['image'] = $filename;
            }
        }

        $package->update($updatePayload);

        $package->services()->sync($payload->get('services'));

        return $package;
    }
}
