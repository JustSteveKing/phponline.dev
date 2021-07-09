<?php

namespace App\Console\Commands\Feeds;

use App\Models\Feed;
use Illuminate\Console\Command;
use Laminas\Feed\Reader\Reader;
use App\Jobs\Feeds\FeedItems\BuildFeedItem;

class FetchFeedItems extends Command
{
    protected $signature = 'feeds:aggregate';

    protected $description = 'Aggregate Feed Items from Feeds';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $feeds = Feed::verified()->get();

        $feeds->map(function (Feed $feed) {
            $importedFeed = Reader::import(
                uri: $feed->feed_url,
            );

            foreach ($importedFeed as $item) {
                $xml = simplexml_load_string($item->saveXML());
                $feedItem = (array) $xml;

                BuildFeedItem::dispatch(
                    $item->getTitle(),
                    $item->getDescription(),
                    $feedItem['author'],
                    $feedItem['link'],
                    $feedItem['pubDate'],
                    $feed->id,
                );
            }
        });
    }
}
