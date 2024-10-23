<?php

namespace App\Modules\MobileModule\Http\Requests;

use App\Next\Core\Request;

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
            'package_id' => 'required|numeric',
            'package_name' => 'required|string',
            'price' => 'required|numeric',
            'sale_date' => 'required|date',
            'address' => 'required|string',
            'nearest_landmark' => 'required|string',
            'nearest_bus_stop' => 'required|string',
        ];
    }
}
