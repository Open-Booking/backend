<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSaleService extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'package_sale_id',
        'customer_id',
        'customer_name',
        'service_id',
        'service_name',
        'expired_date',
        'frequency',
        'remaining_frequency',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function packageSale()
    {
        return $this->belongsTo(PackageSale::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
