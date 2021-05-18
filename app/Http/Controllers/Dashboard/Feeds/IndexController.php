<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\Feeds;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        return view('app.dashboard.feeds.index');
    }
}
