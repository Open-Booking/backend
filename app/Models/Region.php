<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Request;

class Region extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'region_user');
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
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
