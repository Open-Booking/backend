<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Next\Core\Request;
use Illuminate\Validation\Rules\Enum;

class UpdatePackageSaleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'package_id' => 'nullable|numeric',
            'customer_id' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'sale_date' => 'nullable|date',
            'expired_date' => 'nullable|date',
            'address' => 'nullable|string',
            'nearest_landmark' => 'nullable|string',
            'nearest_bus_stop' => 'nullable|string',
            'status' => ['nullable', new Enum(GeneralStatusEnum::class)],
        ];
    }
}
