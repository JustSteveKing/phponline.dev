<?php

namespace App\Http\Livewire\Articles;

use App\Models\Category;
use App\Support\ArticleLevel;
use Livewire\Component;

class CreateArticle extends Component
{
    public string $title = '';

    public string $body = '';

    public string $summary = '';

    public string $level = '';

    public array $levels = ArticleLevel::ALL;

    public int $category;

    public array $categories = [];

    public array $topics = [];

    protected $rules = [
        'title' => ['required', 'string'],
        'summary' => ['required', 'string', 'min:10', 'max:120'],
        'body' => ['required'],
        'level' => ['required'] // @todo Create custom rule.
    ];

    public function submit()
    {
        $this->validate();

        // save article ...

        $this->emit('saved');
    }

    public function mount()
    {
        $this->categories = Category::get()->toArray();
    }

    public function render()
    {
        return view('livewire.articles.create-article');
    }
}
