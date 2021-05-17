<?php

declare(strict_types=1);

namespace App\Console\Commands\Streams;

use App\Models\Stream;
use Illuminate\Console\Command;
use Laminas\Feed\Reader\Reader;

class SyncFromLaraStreams extends Command
{
    protected $signature = 'streams:sync';

    protected $description = 'Sync all streams from larastreamers.com';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $feed = Reader::import(
            uri: config('services.larastreamers.feed.uri'),
        );

        foreach ($feed as $item) {
            $xml = simplexml_load_string($item->saveXML());
            $stream = (array) $xml;
            $link = (array) $stream['link'];

            Stream::updateOrCreate([
                'larastreamers_id' => $stream['id'],
            ], [
                'title' => trim($item->getTitle()),
                'author' => trim(collect($item->getAuthor())->first()),
                'summary' => trim($item->getDescription()),
                'external_url' => $link['@attributes']['href']
            ]);
        }

        return true;
    }
}
