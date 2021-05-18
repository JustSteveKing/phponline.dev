<?php

namespace App\Http\Livewire\Articles;

use Livewire\Component;

class CreateArticle extends Component
{
    public string $title = '';

    public string $body = '';

    public function render()
    {
        return view('livewire.articles.create-article');
    }
}
