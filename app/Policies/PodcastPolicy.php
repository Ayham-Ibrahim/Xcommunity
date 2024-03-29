<?php

namespace App\Policies;

use App\Models\Podcast;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PodcastPolicy
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
    public function view(User $user, Podcast $podcast)
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
    public function update(User $user, Podcast $podcast)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Podcast $podcast)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Podcast $podcast)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Podcast $podcast)
    {
        return $user->hasAnyRole(['owner']);
    }
}
