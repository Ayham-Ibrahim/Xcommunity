<?php

namespace App\Policies;

use App\Models\Advertismaent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdvertismaentPolicy
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
    public function view(User $user, Advertismaent $advertismaent)
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
    public function update(User $user, Advertismaent $advertismaent)
    {
        return $user->hasAnyRole(['owner']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Advertismaent $advertismaent)
    {
        return $user->hasAnyRole(['owner']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Advertismaent $advertismaent)
    {
        return $user->hasAnyRole(['owner']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Advertismaent $advertismaent)
    {
        return $user->hasAnyRole(['owner']);
    }
}
