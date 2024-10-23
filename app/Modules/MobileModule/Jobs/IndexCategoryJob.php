<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\GeneralStatusEnum;
use App\Models\Category;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexCategoryJob extends Job
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
        $order = $request->query('order') ?? [['column' => 'id', 'order' => 'asc']];

        $searchableFields = ['id', 'name'];
        $sortableFields = ['id', 'name'];

        $query = Category::where('status', GeneralStatusEnum::ACTIVE->value)->purifySortingQuery($order, $sortableFields);

        return $query->search($searchableFields, $search)->cleanPaginate($perPage, $page);
    }
}
