<?php

namespace App\Modules\CoreModule\Jobs;

use App\Models\Role;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexRoleJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $page = $request->query('current_page');
        $perPage = $request->query('per_page');
        $search = $request->query('search');
        $order = $request->query('order') ?? [['column' => 'created_at', 'order' => 'desc']];

        $searchableFields = ['id', 'name', 'description'];
        $sortableFields = [
            'id', 'name', 'description', 'created_at',
        ];

        $query = Role::purifySortingQuery($order, $sortableFields);

        return $query->search($searchableFields, $search)->cleanPaginate($perPage, $page);
    }
}
