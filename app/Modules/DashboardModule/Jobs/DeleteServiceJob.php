<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Service;
use App\Next\Core\Job;
use Illuminate\Support\Facades\Storage;

class DeleteServiceJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $serviceId)
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
        $service = Service::findOrFail($this->serviceId);
        if ($service->image) {
            $file = 'public/' . $service->getAttributes()['image'];
            Storage::exists($file) ? Storage::delete($file) : null;
        }

        return $service->delete();
    }
}
