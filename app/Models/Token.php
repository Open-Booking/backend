<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'mobile_number',
        'token',
        'expired_at',
        'tokenable_type',
        'tokenable_id',
        'use_case',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
}
