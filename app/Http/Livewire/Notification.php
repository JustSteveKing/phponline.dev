<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $loaded = false;

    public $title = 'Default notification message';

    public $type = 'success';

    protected $listeners = [
        'notify' => 'renderNotification'
    ];

    public function render()
    {
        return view('livewire.notification');
    }

    public function hide()
    {
        $this->title = '';
        $this->loaded = false;
    }

    public function renderNotification(string $title, string $type = 'success')
    {
        $this->title = $title;
        $this->type = $type;
        $this->loaded = true;
    }
}
