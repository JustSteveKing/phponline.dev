<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Support\Str;

class KeyFactory
{
    public static function generate(string $prefix, int $length = 20): string
    {
        $string = Str::random($length);

        return "{$prefix}{$string}";
    }
}
