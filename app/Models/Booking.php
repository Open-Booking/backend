<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'service_id',
        'service_name',
        'customer_id',
        'customer_name',
        'booking_date',
        'time_slot',
        'booking_time',
        'area_id',
        'address',
        'nearest_landmark',
        'nearest_bus_stop',
        'customer_remark',
        'address',
        'service_location',
        'provider_id',
        'provider_name',
        'status',
    ];

    protected $hidden = [
        'updated_at',
        'created_by',
        'updated_by',
    ];

    // Include 'price' in the JSON response
    // protected $appends = [
    //     'price',
    //     'image',
    // ];

    public function service()
    {
        return $this->belongsTo(Service::class)->select(['id', 'price', 'image']);
    }

    // public function getPriceAttribute()
    // {
    //     return $this->service ? $this->service->price : null;
    // }

    // public function getImageAttribute()
    // {
    //     return $this->service ? $this->service->image : null;
    // }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}
