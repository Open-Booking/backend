<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\BasicAudit;
use App\Traits\SnowflakeID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use BasicAudit, HasApiTokens, HasFactory, Notifiable, SnowflakeID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'role_id',
        'email',
        'full_name',
        'country_code',
        'mobile_number',
        'avatar',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getAvatarAttribute($value)
    {
        if ($value) {
            $path = '/public/' . $value;
            $url = config('app.url') . Storage::url($value);

            return Storage::exists($path) ? $url : null;
        }

        return $value;
    }

    // Accessors / Mutators
    public function getRoleNameAttribute()
    {
        return $this->role->name;
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'region_user');
    }
}
