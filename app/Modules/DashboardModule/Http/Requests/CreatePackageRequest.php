<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Next\Core\Request;

class CreatePackageRequest extends Request
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'nullable|numeric',
            'currency' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'tags' => 'nullable',
            'attributes' => 'nullable',
            'status' => 'nullable',
            'services' => 'required|array',
        ];
    }
}
