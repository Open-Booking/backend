<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Area extends Model
{
    use BasicAudit, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'region_id',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'area_provider');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'area_customer');
    }

    /**
     * Get the name attribute.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $nameArray = json_decode($value, true);
                $lang = Request::query('lang');

                if ($lang && isset($nameArray[$lang])) {
                    return $nameArray[$lang];
                }

                return $nameArray;
            },
            set: fn ($value) => json_encode($value)
        );
    }
}
