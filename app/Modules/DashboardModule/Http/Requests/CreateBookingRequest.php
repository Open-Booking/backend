<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Enums\BookingTimeSlotEnum;
use App\Next\Core\Request;
use Illuminate\Validation\Rules\Enum;

class CreateBookingRequest extends Request
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
            'customer_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'booking_date' => 'required|date',
            'booking_time' => 'nullable',
            'time_slot' => ['nullable', new Enum(BookingTimeSlotEnum::class)],
            'area_id' => 'required|numeric',
            'address' => 'required|string',
            'nearest_landmark' => 'required|string',
            'nearest_bus_stop' => 'required|string',
            'customer_remark' => 'nullable|string',
        ];
    }
}
