<?php

namespace App\Http\Livewire\Feeds;

use App\Models\Feed;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Manage extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.feeds.manage', [
            'feeds' => Feed::with(['owner'])->where('user_id', auth()->id())->paginate()
        ]);
    }
}
