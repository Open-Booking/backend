<?php

namespace App\Modules\DashboardModule\Jobs;

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

        $lang = $request->query('lang') ?? 'en';

        $sortableFields = ['id', 'created_at'];

        //filters
        $tag = $request->query('tag');
        $status = $request->query('status');

        $query = Package::when($status, fn ($query) => $query->where('status', $status))
            ->when($tag, fn ($query) => $query->whereJsonContains('tags', $tag))
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
