<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Helpers\DateBetween;
use App\Models\Customer;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexCustomerJob extends Job
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

        $sortableFields = ['full_name', 'created_at'];

        //filters
        $dateBetween = $request->get('date_between') ?? [];
        $area_id = $request->get('area_id');
        $status = $request->query('status');

        $query = Customer::with('area')->when($status, fn ($query) => $query->where('status', $status))
            ->when($area_id, fn ($query) => $query->where('area_id', $area_id))
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%");
            });

        $query = DateBetween::dateBetween($query, $dateBetween);

        return $query->purifySortingQuery($order, $sortableFields)->cleanPaginate($perPage, $page);
    }
}
