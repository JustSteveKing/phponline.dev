<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feed extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'url',
        'meta',
        'verification_token',
        'verified',
        'user_id',
    ];

    protected $casts = [
        'meta' => 'json',
        'verified' => 'boolean',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
