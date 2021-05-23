<?php

declare(strict_types=1);

namespace App\Jobs\Feeds;

use App\Models\Feed;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use shweshi\OpenGraph\OpenGraph;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class FetchMetaData implements ShouldQueue
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
        $feed = Feed::find($this->feedId);

        // do stuff
        $data = (new OpenGraph())->fetch(
            url: $feed->url,
            allMeta: true,
        );

        $feed->update([
            'body' => $data['description'] ?? $feed->description,
            'meta' => array_filter($data, fn($value) => !is_null($value) && $value !== '')
        ]);
    }
}
