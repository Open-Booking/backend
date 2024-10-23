<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Helpers\DateBetween;
use App\Models\Booking;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexBookingJob extends Job
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
        $serviceId = $request->query('service_id');
        $customerId = $request->query('customer_id');
        $areaId = $request->query('area_id');
        $dateBetween = $request->get('date_between') ?? []; // booking date between

        $query = Booking::with('area')->when($status, fn ($query) => $query->where('status', $status))
            ->when($serviceId, fn ($query) => $query->where('service_id', $serviceId))
            ->when($customerId, fn ($query) => $query->where('customer_id', $customerId))
            ->when($areaId, fn ($query) => $query->where('area_id', $areaId))
            ->when($search, function ($query) use ($search) {
                $query->where('service_name', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%");
            });

        $query = DateBetween::dateBetween($query, $dateBetween, 'booking_date');

        return $query->purifySortingQuery($order, $sortableFields)->cleanPaginate($perPage, $page);
    }
}
