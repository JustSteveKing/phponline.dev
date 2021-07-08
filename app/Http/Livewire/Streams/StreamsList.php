<?php

declare(strict_types=1);

namespace App\Http\Livewire\Streams;

use App\Models\Stream;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Ramsey\Uuid\Uuid;

class StreamsList extends Component
{
    public array $streams;
    public array $authors;
    public array $selected = [];
    public string $query = '';

    protected $listeners = [
        'authorSelected' => 'selected'
    ];

    public function mount(): void
    {
        $streams = Stream::all();

        $this->authors = $streams->map(function($stream) {
            return [
                'name' => $stream->author,
                'id' => Uuid::uuid4()->toString(),
            ];
        })->unique(
            key: 'name',
        )->toArray();

        $this->streams = $streams->toArray();
    }

    public function selected($payload): void
    {
        $this->streams = Stream::whereAuthor($payload['author'])->get()->toArray();
    }

    public function render(): View
    {
        return view('livewire.streams.streams-list');
    }
}
