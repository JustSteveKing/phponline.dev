<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Feed;
use App\Models\Package;
use App\Models\Podcast;
use App\Observers\FeedObserver;
use App\Observers\PackageObserver;
use App\Observers\PodcastObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }
    public function boot()
    {
        Feed::observe(FeedObserver::class);
        Package::observe(PackageObserver::class);
        Podcast::observe(PodcastObserver::class);
    }
}
