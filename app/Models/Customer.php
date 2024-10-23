<?php

namespace App\Models;

use App\Traits\BasicAudit;
use App\Traits\SnowflakeID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use BasicAudit, HasFactory, SnowflakeID;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'country_code',
        'mobile_number',
        'avatar',
        'status',
        'customer_location',
        'address',
        'attributes',
        'area_id',
    ];

    protected $casts = [
        'attributes' => 'array',
        'created_at' => 'date:d/m/Y'
    ];

    protected $hidden = [
        'updated_at',
        'created_by',
        'updated_by',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
