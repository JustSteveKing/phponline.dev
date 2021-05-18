<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\Feeds;

use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Request $request, Feed $feed): View
    {
        $this->authorize('view', $feed);

        return view('app.dashboard.feeds.show', compact('feed'));
    }
}
