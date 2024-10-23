<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Next\Core\Request;

class UpdatePackageRequest extends Request
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
            'name' => 'nullable|array',
            'description' => 'nullable|array',
            'price' => 'nullable|numeric',
            'currency' => 'nullable',
            'image' => 'nullable',
            'image_updated' => 'required',
            'tags' => 'nullable|json',
            'attributes' => 'nullable|json',
            'services' => 'required|array',
            'status' => 'nullable',
        ];
    }
}
