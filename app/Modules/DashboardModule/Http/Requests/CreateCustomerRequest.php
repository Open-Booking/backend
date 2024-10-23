<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Enums\REGXEnum;
use App\Next\Core\Request;

class CreateCustomerRequest extends Request
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

        return [
            'full_name' => 'required|string',
            'mobile_number' => "required|string|unique:customers|regex:$mobileNumberRegx",
            'area_id' => 'required|numeric|min:1',
            'address' => 'required',
            'attributes' => 'nullable', /* { nearest_landmark: "xxx", nearest_bus_stop: "xxx"} */
            'customer_location' => 'nullable',
            'status' => 'required'
        ];
    }
}
