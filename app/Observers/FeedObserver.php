<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\Feeds\FetchMetaData;
use App\Models\Feed;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class FeedObserver
{
    public function creating(Feed $feed): void
    {
        $feed->verification_token = Str::key(
            prefix: 'phponline:',
            length: 12,
        );
        $feed->uuid = Uuid::uuid4()->toString();
    }

    public function created(Feed $feed): void
    {
        FetchMetaData::dispatch(
            $feed->id
        );
    }

    public function updated(Feed $feed): void
    {
        if (array_key_exists(config('phponline.verification.feeds.key'), $feed->meta)) {
            $feed->update([
                'verified' => true,
            ]);
        }
    }
}
