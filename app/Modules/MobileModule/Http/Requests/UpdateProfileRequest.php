<?php

namespace App\Modules\MobileModule\Http\Requests;

use App\Next\Core\Request;

class UpdateProfileRequest extends Request
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
            'full_name' => 'nullable|string',
            'customer_location' => 'nullable',
            'area_id' => 'nullable',
            'address' => 'nullable',
            'attributes' => 'nullable|array',
        ];
    }
}
