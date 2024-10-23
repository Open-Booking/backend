<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\GeneralStatusEnum;
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

        $lang = $request->query('lang');

        // $searchableFields = ['name'];
        $sortableFields = ['id', 'name'];

        //filters
        $category_id = $request->query('category_id');
        $tag = $request->query('tag');

        $query = Service::where('status', GeneralStatusEnum::ACTIVE->value)
            ->when($category_id, fn ($query) => $query->where('category_id', $category_id))
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
