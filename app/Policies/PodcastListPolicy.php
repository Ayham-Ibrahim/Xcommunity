<?php

namespace App\Policies;

use App\Models\PodcastList;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PodcastListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['owner','user']);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PodcastList $podcastList)
    {
        return $user->hasAnyRole(['owner','user']);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PodcastList $podcastList)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PodcastList $podcastList)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PodcastList $podcastList)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PodcastList $podcastList)
    {
        return $user->hasAnyRole(['owner']);

    }
}
