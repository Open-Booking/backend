<?php

namespace App\Modules\CoreModule\Jobs;

use App\Helpers\DateBetween;
use App\Models\User;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexUserJob extends Job
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
        $perPage = $request->query('per_page'); // if there is no params, all will return
        $search = $request->query('search');
        $order = $request->query('order') ?? [['column' => 'created_at', 'order' => 'desc'], ['column' => 'name', 'order' => 'asc']];

        $searchableFields = ['id', 'username', 'email', 'full_name', 'mobile_number'];
        $sortableFields = [
            'id', 'username', 'email', 'full_name', 'mobile_number', 'created_at', 'updated_at',
        ];

        /** Filters */
        $dateBetween = $request->get('date_between') ?? [];
        $role_id = $request->get('role_id');
        $status = $request->get('status');

        $query = User::with('role')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($role_id, fn ($query) => $query->where('role_id', $role_id));

        $query = DateBetween::dateBetween($query, $dateBetween);

        return $query->purifySortingQuery($order, $sortableFields)->search($searchableFields, $search)->cleanPaginate($perPage, $page);
    }
}
