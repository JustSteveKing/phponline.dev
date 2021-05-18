<?php

namespace App\Jobs\Feeds;

use App\Models\Feed;
use RuntimeException;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class CheckVerification implements ShouldQueue
{
    use Batchable;
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue;

    public function __construct(
        public int $feedId,
    ) {}

    public function handle()
    {
        if ($this->batch()->canceled()) {
            return;
        }

        $feed = Feed::find($this->feedId);
        $key = config('phponline.verification.feeds.key');

        if (array_key_exists($key, $feed->meta)) {
            if ($feed->meta[$key] === $feed->verification_token) {
                Log::info('Verification success');
                $feed->update([
                    'verified' => true
                ]);
                
                return;
            }
        } else {
            Log::error("Failed verification");
            throw new RuntimeException(
                "Verification failed"
            );
        }
    }
}
