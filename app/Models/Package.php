<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'image',
        'attributes',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'name' => 'array',
        'price' => 'integer',
        'description' => 'array',
        'attributes' => 'array',
    ];

    public function getImageAttribute($value)
    {
        if ($value) {
            $path = '/public/' . $value;
            $url = config('app.url') . Storage::url($value);

            return Storage::exists($path) ? $url : null;
        }

        return $value;
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'package_service')->withPivot(['package_id', 'service_id', 'frequency']);
    }

    /**
     * Get the name attribute.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $valueArray = json_decode($value, true);
                $lang = Request::query('lang');

                if ($lang && isset($valueArray[$lang])) {
                    return $valueArray[$lang];
                }

                return $valueArray;
            },
            set: fn ($value) => json_encode($value)
        );
    }

    /**
     * Get the description attribute.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $valueArray = json_decode($value, true);
                $lang = Request::query('lang');

                if ($lang && isset($valueArray[$lang])) {
                    return $valueArray[$lang];
                }

                return $valueArray;
            },
            set: fn ($value) => json_encode($value)
        );
    }
}
