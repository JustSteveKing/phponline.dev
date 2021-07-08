<?php

namespace App\Http\Controllers\Static\Users\Feeds;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(
        Request $request,
        User $user,
        Feed $feed
    ) {
        // authorization
        $feed->load(['items']);

        return view(
            'static.profiles.feeds.show',
            compact('user', 'feed')
        );
    }
}
