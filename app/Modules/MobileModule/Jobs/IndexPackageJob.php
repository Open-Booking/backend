<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\GeneralStatusEnum;
use App\Models\Package;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexPackageJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $page = $request->query('current_page');
        $perPage = $request->query('per_page') ?? 'all'; // if there is no params, all will return
        $search = $request->query('search');
        $order = $request->query('order') ?? [['column' => 'created_at', 'order' => 'desc']];

        $searchableFields = ['id', 'name'];
        $sortableFields = ['id', 'name'];

        //filters
        $tag = $request->query('tag');

        $query = Package::where('status', GeneralStatusEnum::ACTIVE->value)
            ->when($tag, fn ($query) => $query->whereJsonContains('tags', $tag));

        return $query->purifySortingQuery($order, $sortableFields)->search($searchableFields, $search)->cleanPaginate($perPage, $page);
    }
}
