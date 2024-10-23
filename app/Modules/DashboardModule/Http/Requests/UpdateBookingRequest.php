<?php

namespace App\Modules\DashboardModule\Http\Requests;

use App\Enums\BookingStatusEnum;
use App\Enums\BookingTimeSlotEnum;
use App\Next\Core\Request;
use Illuminate\Validation\Rules\Enum;

class UpdateBookingRequest extends Request
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
            'customer_id' => 'nullable|numeric',
            'service_id' => 'nullable|numeric',
            'booking_date' => 'nullable|date',
            'booking_time' => 'nullable',
            'time_slot' => ['nullable', new Enum(BookingTimeSlotEnum::class)],
            'area_id' => 'required|numeric',
            'address' => 'nullable|string',
            'nearest_landmark' => 'nullable|string',
            'nearest_bus_stop' => 'nullable|string',
            'customer_remark' => 'nullable|string',
            'status' => ['nullable', new Enum(BookingStatusEnum::class)],
        ];
    }
}
