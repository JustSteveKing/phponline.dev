<?php

namespace App\Http\Livewire\Feeds;

use App\Models\Feed;
use Livewire\Component;
use Illuminate\Support\Str;
use Laminas\Feed\Reader\Reader;

class CreateFeed extends Component
{
    public string $title = '';

    public string $url = '';

    public bool $checked = false;

    public array $feeds = [];

    public string $feed = '';

    protected $rules = [
        'title' => ['required', 'string', 'max:240'],
        'url' => ['required', 'url'],
    ];

    public function checkURL(): void
    {
        $this->validate();

        $feedLinks = Reader::findFeedLinks(
            uri: $this->url,
        );

        if (count($feedLinks) < 1) {
            $this->addError(
                'url',
                'Cannot verify this URL to have any type of RSS or ATOM feed'
            );
        } else {
            if (! is_null($feedLinks->rss)) {
                array_push(
                    $this->feeds,
                    [
                        'type' => 'rss',
                        'href' => $feedLinks->rss
                    ]
                );
            }

            if (! is_null($feedLinks->atom)) {
                array_push(
                    $this->feeds,
                    [
                        'type' => 'atom',
                        'href' => $feedLinks->atom,
                    ],
                );
            }

            $this->checked = true;
        }
    }

    public function submitFeed()
    {
        $feeds = collect($this->feeds);

        $feed = $feeds->where('type', $this->feed)->first();

        // create feed
        $feed = Feed::create([
            'title' => $this->title,
            'url' => $this->url,
            'feed_url' => $feed['href'],
            'user_id' => auth()->id(),
        ]);

        $this->reset();

        $meta = config('phponline.verification.feeds.key');

        session()->flash(
            'verified',
            "Please create a meta tag on your website to verify ownership.<br />Use the name of '{$meta}' with the content: {$feed->verification_token}"
        );

        $this->redirect(route('dashboard:feeds:index'));
    }

    public function render()
    {
        return view('livewire.feeds.create-feed');
    }
}
