<?php

declare(strict_types=1);

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'twitter',
        'github',
        'available',
        'company_id',
        'job_title_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'available' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(
            JobTitle::class,
            'job_title_id',
        );
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(
            Company::class,
            'company_id',
        );
    }

    public function articles(): HasMany
    {
        return $this->hasMany(
            Article::class,
            'user_id',
        );
    }

    public function packages(): HasMany
    {
        return $this->hasMany(
            Package::class,
            'user_id',
        );
    }
}
