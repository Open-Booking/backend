<?php

namespace App\Models;

use App\Traits\BasicAudit;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use BasicAudit, HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'category_id',
        'price',
        'currency',
        'hours',
        'image',
        'tags',
        'attributes',
        'status',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'attributes' => 'array',
        'tags' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_service');
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
