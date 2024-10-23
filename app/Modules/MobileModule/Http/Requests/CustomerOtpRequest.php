<?php

namespace App\Modules\MobileModule\Http\Requests;

use App\Enums\REGXEnum;
use App\Next\Core\Request;

class CustomerOtpRequest extends Request
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
        $rules = [];

        if ($this->route('channel') === 'email') {
            $rules['email'] = 'email|required';
        } elseif ($this->route('channel') === 'sms') {
            $rules['mobile_number'] = "required|string|regex:$mobileNumberRegx";
        }

        return $rules;
    }
}
