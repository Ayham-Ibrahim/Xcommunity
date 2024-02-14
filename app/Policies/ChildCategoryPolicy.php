<?php

namespace App\Policies;

use App\Models\ChildCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChildCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ChildCategory $childCategory)
    {
        return $user->hasAnyRole(['owner']);

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
    public function update(User $user, ChildCategory $childCategory)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ChildCategory $childCategory)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ChildCategory $childCategory)
    {
        return $user->hasAnyRole(['owner']);

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ChildCategory $childCategory)
    {
        return $user->hasAnyRole(['owner']);

    }
}
