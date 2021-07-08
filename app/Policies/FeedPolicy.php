<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Feed $feed): bool
    {
        return $feed->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feed  $feed
     * @return mixed
     */
    public function update(User $user, Feed $feed)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feed  $feed
     * @return mixed
     */
    public function delete(User $user, Feed $feed)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feed  $feed
     * @return mixed
     */
    public function restore(User $user, Feed $feed)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Feed  $feed
     * @return mixed
     */
    public function forceDelete(User $user, Feed $feed)
    {
        //
    }
}
