<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Feed;
use Illuminate\Support\Str;

class FeedObserver
{
    public function created(Feed $feed): void
    {
        $feed->verification_token = Str::key(
            prefix: 'phponline:',
            length: 12,
        );
    }
}
