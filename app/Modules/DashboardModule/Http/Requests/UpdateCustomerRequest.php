<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Enums\REGXEnum;
use App\Next\Core\Request;

class UpdateCustomerRequest extends Request
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
        $mobileNumberRegx = REGXEnum::MOBILE_NUMBER->value;
        $userId = $this->route('id');

        return [
            'full_name' => 'nullable|string',
            'mobile_number' => "nullable|string|unique:customers,mobile_number,$userId,id|regex:$mobileNumberRegx",
            'area_id' => 'nullable|numeric|min:1',
            'address' => 'nullable',
            'attributes' => 'nullable', /* { nearest_landmark: "xxx", nearest_bus_stop: "xxx"} */
            'customer_location' => 'nullable',
            'status' => 'nullable',
        ];
    }
}
