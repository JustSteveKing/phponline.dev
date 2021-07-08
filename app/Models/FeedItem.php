<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedItem extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'external_url',
        'published_at',
        'meta',
        'feed_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'meta' => 'array',
    ];

    public function feed(): BelongsTo
    {
        return $this->belongsTo(
            related: Feed::class,
            foreignKey: 'feed_id',
        );
    }
}
