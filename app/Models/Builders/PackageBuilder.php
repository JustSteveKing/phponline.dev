<?php

declare(strict_types=1);

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class PackageBuilder extends Builder
{
    public function published(): self
    {
        $this->where('published', true);

        return $this;
    }

    public function unPublished(): self
    {
        $this->where('published', false);

        return $this;
    }
}
