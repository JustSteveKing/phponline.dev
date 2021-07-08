<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'title',
        'external_url',
        'author',
        'summary',
        'larastreamers_id'
    ];
}
