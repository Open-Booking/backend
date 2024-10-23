<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Service;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class IndexServiceJob extends Job
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

        $lang = $request->query('lang') ?? 'en';

        $sortableFields = ['id', 'name', 'created_at'];

        //filters
        $categoryId = $request->query('category_id');
        $tag = $request->query('tag');
        $status = $request->query('status');

        $query = Service::with('category')->when($status, fn ($query) => $query->where('status', $status))
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
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
