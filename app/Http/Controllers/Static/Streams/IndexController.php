<?php

declare(strict_types=1);

namespace App\Http\Controllers\Static\Streams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('static.streams.index');
    }
}
