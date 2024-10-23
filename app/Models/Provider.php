<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'id',
        'name',
        'title',
        'avatar',
        'attributes',
        'status',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_provider');
    }
}
