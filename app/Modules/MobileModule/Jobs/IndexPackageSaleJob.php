<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\GeneralStatusEnum;
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
        $order = $request->query('order') ?? [['column' => 'id', 'order' => 'asc']];

        $lang = $request->query('lang');

        $sortableFields = ['id', 'created_at'];

        //filters
        $status = $request->query('status');
        switch ($status) {
            case 'ACTIVE': $status = [GeneralStatusEnum::ACTIVE->value, GeneralStatusEnum::PENDING];
                break;
            case 'INACTIVE': $status = [GeneralStatusEnum::INACTIVE->value];
                break;
        }

        $customer_id = auth()->id();
        $query = PackageSale::with('services', 'package')->where('customer_id', $customer_id)
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
