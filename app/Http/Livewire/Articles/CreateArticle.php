<?php

namespace App\Http\Livewire\Articles;

use App\Models\Category;
use App\Support\ArticleLevel;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use Livewire\Component;
use Spatie\CommonMarkHighlighter\FencedCodeRenderer;
use Spatie\CommonMarkHighlighter\IndentedCodeRenderer;

class CreateArticle extends Component
{
    public string $title = '';

    public string $body = '';

    public string $markedBody = '';

    public string $summary = '';

    public string $level = '';

    public array $levels = ArticleLevel::ALL;

    public int $category;

    public array $categories = [];

    public array $topics = [];

    public $listeners = ['refresh' => '$refresh'];

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

    public function markedField($field)
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addBlockRenderer(FencedCode::class, new FencedCodeRenderer());
        $environment->addBlockRenderer(IndentedCode::class, new IndentedCodeRenderer());

        $converter = new CommonMarkConverter([], $environment);

        return $converter->convertToHtml($this->{$field});
    }

    public function render()
    {
        return view('livewire.articles.create-article');
    }
}
