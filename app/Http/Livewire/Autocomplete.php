<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class Autocomplete extends Component
{
    public string $model;
    public ?string $emits;
    public string $searchKey;
    public string $query = '';
    public array $results = [];
    public ?string $createEvent;
    public bool $searching = false;

    protected $listeners = [
        'hide-dropdown' => 'hideDropdown'
    ];

    public function mount(
        string $model,
        string $searchKey,
        ?string $emits = null,
        ?string $createEvent = null,
        ?string $initialValue = '',
    ) {
        $this->model = $model;
        $this->emits = $emits;
        $this->query = $initialValue;
        $this->searchKey = $searchKey;
        $this->createEvent = $createEvent;
    }

    public function hideDropdown(): void
    {
        $this->searching = false;
    }

    public function updated()
    {
        $model = new $this->model;
        $this->searching = true;

        $results = $model->where(
            $this->searchKey,
            'LIKE',
            "%{$this->query}%",
        )->get();

        $this->results = $results->toArray();
    }

    public function selectAll(): void
    {
        $this->emit('reset');
        $this->query = '';

        $this->searching = false;
    }

    public function selected(string $id): void
    {
        $model = (new $this->model)->find($id);
        $this->emit(
            $this->emits,
            $model
        );
        $this->query = $model->{$this->searchKey};

        $this->searching = false;
    }

    public function render()
    {
        return view('livewire.autocomplete');
    }
}
