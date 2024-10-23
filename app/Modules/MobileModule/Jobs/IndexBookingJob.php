<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\BookingStatusEnum;
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
        $order = $request->query('order') ?? [['column' => 'id', 'order' => 'asc']];

        $lang = $request->query('lang');

        $sortableFields = ['id', 'created_at'];

        //filters
        $status = $request->query('status');
        switch ($status) {
            case 'ONGOING': $status = [BookingStatusEnum::BOOKED->value, BookingStatusEnum::ACKNOWLEDGED->value, BookingStatusEnum::CONFIRMED->value];
                break;
            case 'COMPLETED': $status = [BookingStatusEnum::COMPLETED->value];
                break;
        }

        $customer_id = auth()->id();
        $query = Booking::with('service')->where('customer_id', $customer_id)
            ->when($status, function ($query) use ($status) {
                $query->whereIn('status', $status);
            })
            ->when($search, function ($query) use ($search, $lang) {
                if ($lang === 'en') {
                    $query->where('name->en', 'like', "%{$search}%");
                } elseif ($lang === 'mm') {
                    $query->where('name->mm', 'like', "%{$search}%");
                }
            });

        return $query->purifySortingQuery($order, $sortableFields)->cleanPaginate($perPage, $page);
    }
}
