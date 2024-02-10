<?php

namespace App\Http\Traits;

use App\Models\Follow;
use App\Models\User;

trait FollowTrait
{
    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }


    public function followToggle (User $user){
        if ($this->hasFollowedByUser($user)){
            $this->unFollow($user);
            return $message = 'you are Unfollowing ' . get_class($this);
        } else {
            $this->follow($user);
            return $message = 'you are following ' . get_class($this);
        }
    }

    public function hasFollowedByUser(User $user)
    {
        return $this->followers()->where('user_id', $user->id)
            ->where('followable_id', $this->id)
            ->where('followable_type', get_class($this))
            ->exists();
    }

    public function follow(User $user)
    {
        dd($this->id);
        $existingLike = $this->followers()->where([
            'followable_id'     => $this->id,
            'followable_type'   => get_class($this),
            'user_id'           => $user->id,
        ])->first();

        // If the user hasn't liked the blog, create a new like
        if (!$existingLike) {
            $this->followers()->create([
                'followable_id'     => $this->id,
                'followable_type'   => get_class($this),
                'user_id'           => $user->id,
            ]);
        }
    }


    public function unFollow(User $user)
    {
        $user->followers()->where([
            'user_id' => $user->id,
            'followable_id'     => $this->id,
            'followable_type'   => get_class($this),
        ])->delete();
    }

    public function followersCount()
    {
        return $this->followers->count();
    }
}
