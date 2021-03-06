<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (App::environment('local')) {
            Article::factory(50)->create();
            
            $this->call([
                LocalUserSeeder::class,
                PackageSeeder::class,
                TopicSeeder::class,
            ]);

            $this->call([
                PodcastSeeder::class,
            ]);
        }
    }
}
