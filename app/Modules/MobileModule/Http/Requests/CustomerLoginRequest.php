<?php

namespace App\Modules\MobileModule\Http\Requests;

use App\Next\Core\Request;

class CustomerLoginRequest extends Request
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
            'identifier' => 'string|required',
            'password' => 'string|required',
        ];
    }
}
