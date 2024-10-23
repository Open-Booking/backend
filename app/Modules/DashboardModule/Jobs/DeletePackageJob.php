<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Package;
use App\Next\Core\Job;
use Illuminate\Support\Facades\Storage;

class DeletePackageJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $packageId)
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
        $package = Package::findOrFail($this->packageId);
        if ($package->image) {
            $file = 'public/' . $package->getAttributes()['image'];
            Storage::exists($file) ? Storage::delete($file) : null;
        }

        $package->services()->detach();

        return $package->delete();
    }
}
