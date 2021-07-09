<?php

namespace App\Http\Livewire\Feeds;

use App\Models\FeedItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class LatestItems extends Component
{
    /**
     * @var Collection
     */
    public $feedItems;

    public function mount(): void
    {
        $this->feedItems = FeedItem::with(['feed'])
            ->whereHas('feed', function (Builder $builder) {
                $builder->where('verified', true);
            })
            ->latest()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.feeds.latest-items');
    }
}
