<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackageSale extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'customer_name',
        'package_id',
        'package_name',
        'price',
        'sale_date',
        'expired_date',
        'address',
        'nearest_landmark',
        'nearest_bus_stop',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class)->select(['id', 'price', 'image']);
    }

    public function services(): HasMany
    {
        return $this->hasMany(PackageSaleService::class);
    }
}
