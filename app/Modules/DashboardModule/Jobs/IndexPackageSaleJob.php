<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Helpers\DateBetween;
use App\Models\PackageSale;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexPackageSaleJob extends Job
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

        $sortableFields = ['created_at'];

        //filters
        $status = $request->query('status');
        $packageId = $request->query('package_id');
        $customerId = $request->query('customer_id');
        $dateBetween = $request->get('date_between') ?? []; // sale date between

        $query = PackageSale::when($status, fn ($query) => $query->where('status', $status))
            ->when($packageId, fn ($query) => $query->where('package_id', $packageId))
            ->when($customerId, fn ($query) => $query->where('customer_id', $customerId))
            ->when($search, function ($query) use ($search) {
                $query->where('package_name', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%");
            });

        $query = DateBetween::dateBetween($query, $dateBetween, 'sale_date');

        return $query->purifySortingQuery($order, $sortableFields)->cleanPaginate($perPage, $page);
    }
}
