<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Next\Core\Request;
use Illuminate\Validation\Rules\Enum;

class CreatePackageSaleRequest extends Request
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
            'customer_id' => 'required|numeric',
            'package_id' => 'required|numeric',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
            'expired_date' => 'required|date',
            'address' => 'required|string',
            'nearest_landmark' => 'required|string',
            'nearest_bus_stop' => 'required|string',
            'status' => new Enum(GeneralStatusEnum::class),
        ];
    }
}
