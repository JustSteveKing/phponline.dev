<?php

namespace App\Http\Livewire\Feeds;

use App\Models\Feed;
use Livewire\Component;
use shweshi\OpenGraph\OpenGraph;

class CheckMetaButton extends Component
{
    public int $feedID;
    public string $url;
    public bool $verified;

    public function checkVerification()
    {
        $data = collect((new OpenGraph())->fetch(
            url: $this->url,
            allMeta: true,
        ));

        if ($data->contains(
            key: config('phponline.verification.feeds.key'),
        )) {
            $this->verified = true;
            $this->emit(
                'notify',
                "Your feed for {$this->url} has been verified",
                'success'
            );
        } else {
            $this->emit(
                'notify',
                "We are currently unable to verify your feed. Please ensure the meta tag has been added",
                'warning'
            );
        }
    }

    public function mount(Feed $feed)
    {
        $this->feedID = $feed->id;
        $this->url = $feed->url;
        $this->verified = $feed->verified;
    }

    public function render()
    {
        return view('livewire.feeds.check-meta-button');
    }
}
