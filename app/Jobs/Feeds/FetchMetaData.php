<?php

declare(strict_types=1);

namespace App\Jobs\Feeds;

use App\Models\Feed;
use Illuminate\Bus\Queueable;
use shweshi\OpenGraph\OpenGraph;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class FetchMetaData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $feedId,
    ) {}

    /**
     * Execute the job.
     *
     * @return void
     */
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
