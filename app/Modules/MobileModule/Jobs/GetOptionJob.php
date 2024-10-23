<?php

namespace App\Modules\MobileModule\Jobs;

use App\Models\Area;
use App\Models\Provider;
use App\Models\Region;
use App\Next\Core\Job;
use Illuminate\Http\Request;

class GetOptionJob extends Job
{
    /**
     * Create a new job instance.
     */
    public function __construct(private readonly string $key)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        $page = $request->input('current_page');
        $perPage = $request->input('per_page') ?? 'all';
        $data = [];
        switch ($this->key) {
            case 'region':
                if ($perPage == 'all') {
                    $data['data'] = Region::select('id', 'name')->get()->toArray();
                } else {
                    $data = Region::select(['id', 'name'])->cleanPaginate($perPage, $page);
                }
                break;

            case 'area':
                if ($perPage == 'all') {
                    $data['data'] = Area::with('region')->select('areas.id', 'areas.name', 'region_id')->get()
                        ->map(function ($area) {
                            return [
                                'id' => $area->id,
                                'name' => $area->name,
                                'region_name' => $area->region->name,
                            ];
                        })
                        ->toArray();
                } else {
                    $data = Area::with('region')->select(['id', 'name', 'region.name'])->cleanPaginate($perPage, $page);
                }
                break;

            case 'provider':
                if ($perPage == 'all') {
                    $data['data'] = Provider::select('id', 'name')->get()->toArray();
                } else {
                    $data = Provider::select(['id', 'name'])->cleanPaginate($perPage, $page);
                }
                break;
        }

        return $data;

    }
}
