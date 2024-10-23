<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Next\Core\Request;

class CreateServiceRequest extends Request
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
            'category_id' => 'required|numeric|min:1',
            'price' => 'nullable|numeric',
            'currency' => 'nullable',
            'hours' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
            'tags' => 'nullable|json',
            'attributes' => 'nullable|json',
            'status' => 'nullable',
        ];
    }
}
