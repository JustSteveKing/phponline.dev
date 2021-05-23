<?php

namespace App\Http\Controllers\Static\Users;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->load(
            relations: [
                'feeds',
                'podcasts',
                'packages',
            ],
        );

        return view('static.profiles.show', compact('user'));
    }
}
