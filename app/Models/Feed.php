<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feed extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'url',
        'feed_url',
        'meta',
        'verification_token',
        'verified',
        'user_id',
    ];

    protected $casts = [
        'meta' => 'array',
        'verified' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
