<?php

namespace App\Modules\MobileModule\Http\Requests;

use App\Enums\REGXEnum;
use App\Next\Core\Request;

class CustomerRegisterRequest extends Request
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
            'otp' => 'required|string',
            'area_id' => 'required|numeric|min:1',
            'address' => 'required',
            'attributes' => 'nullable',
            'customer_location' => 'nullable',
        ];
    }
}
