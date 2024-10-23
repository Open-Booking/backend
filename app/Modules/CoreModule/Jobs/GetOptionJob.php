<?php

namespace App\Modules\CoreModule\Jobs;

use App\Enums\BookingStatusEnum;
use App\Enums\GeneralStatusEnum;
use App\Helpers\StringUtility;
use App\Models\Ability;
use App\Models\Area;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Package;
use App\Models\PackageSale;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
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
        $perPage = $request->input('per_page');
        $data = [];
        switch ($this->key) {
            case 'ability':
                $data['data'] = Ability::select('id', 'action', 'subject')
                    ->get()
                    ->groupBy('subject')
                    ->map(function ($item) {
                        return $item->map(function ($t) {
                            return [
                                'id' => $t->id,
                                'action' => $t->action,
                                'subject' => $t->subject,
                                'action_name' => StringUtility::snakeCaseToTitleCase($t->action),
                                'subject_name' => StringUtility::camelCaseToTitleCase($t->subject),
                            ];
                        });
                    })
                    ->toArray();
                break;
            case 'user':
                if ($perPage == 'all') {
                    $data['data'] = User::select('id', 'full_name')->get()->toArray();
                } else {
                    $data = User::select(['id', 'full_name'])->cleanPaginate($perPage, $page);
                }
                break;
            case 'role':
                if ($perPage == 'all') {
                    $data['data'] = Role::select('id', 'name')->get()->toArray();
                } else {
                    $data = Role::select(['id', 'name'])->cleanPaginate($perPage, $page);
                }
                break;
            case 'category':
                if ($perPage == 'all') {
                    $data['data'] = Category::select('id', 'name')->get()->toArray();
                } else {
                    $data = Category::select(['id', 'name'])->cleanPaginate($perPage, $page);
                }
                break;
            case 'service':
                if ($perPage == 'all') {
                    $data['data'] = Service::join('categories', 'categories.id', '=', 'services.category_id')->select('services.id', 'services.name', 'category_id')->get()->toArray();
                } else {
                    $data = Service::join('categories', 'categories.id', '=', 'services.category_id')->select('services.id', 'services.name', 'category_id')->cleanPaginate($perPage, $page);
                }
                break;
            case 'package':
                if ($perPage == 'all') {
                    $data['data'] = Package::select(['id', 'name', 'price'])->get()->toArray();
                } else {
                    $data = Package::select(['id', 'name', 'price'])->cleanPaginate($perPage, $page);
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
                    $data = Area::with('region')->select(['areas.id', 'areas.name'])->cleanPaginate($perPage, $page);
                }
                break;
            case 'customer':
                if ($perPage == 'all') {
                    $data['data'] = Customer::select('id', 'full_name')->get()->toArray();
                } else {
                    $data = Customer::select(['id', 'full_name'])->cleanPaginate($perPage, $page);
                }
                break;
            case 'noti-count':
                $newBookingCount = Booking::where('status', BookingStatusEnum::BOOKED->value)->count();
                $newOrderCount = PackageSale::where('status', GeneralStatusEnum::PENDING->value)->count();
                $data['data'] = [
                    "booking" => $newBookingCount,
                    "order" => $newOrderCount
                ];
                break;
        }

        return $data;

    }
}
