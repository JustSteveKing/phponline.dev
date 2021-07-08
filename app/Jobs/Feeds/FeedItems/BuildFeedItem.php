<?php

namespace App\Jobs\Feeds\FeedItems;

use Carbon\Carbon;
use App\Models\FeedItem;
use Illuminate\Bus\Queueable;
use shweshi\OpenGraph\OpenGraph;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class BuildFeedItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $author,
        public string $link,
        public string $pubDate,
        public int $feedID,
    ) {}

    public function handle(): void
    {
        $feedItem = FeedItem::updateOrCreate([
            'external_url' => $this->link,
        ], [
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'published_at' => Carbon::parse($this->pubDate),
            'feed_id' => $this->feedID,
        ]);

        $data = (new OpenGraph())->fetch(
            url: $feedItem->external_url,
            allMeta: true,
        );

        $feedItem->update([
            'meta' => array_filter($data, fn($value) => !is_null($value) && $value !== ''),
        ]);
    }
}
