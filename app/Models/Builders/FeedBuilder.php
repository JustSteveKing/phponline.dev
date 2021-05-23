<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class FeedBuilder extends Builder
{
    public function verified(): self
    {
        $this->where('verified', true);

        return $this;
    }
}
