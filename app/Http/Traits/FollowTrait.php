<?php

namespace App\Http\Traits;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait FollowTrait
{
    public function followers()
    {
        return $this->morphMany(Follow::class, 'followable');
    }


    public function followToggle (User $user){
        if ($this->hasFollowedByUser($user)){
            $this->unFollow($user);
            return $message = 'you are Unfollowing ' . $this->title;
        } else {
            DB::beginTransaction();
            try {
                $this->follow($user);

            if ($this->section->name == 'Store' ){
                activity()->causedBy($user)->log('You  have followed a '. $this->type .' about ' . $this->title);
            }
            activity()->causedBy($user)->log('You have followed a '. $this->section .' about ' . $this->title);

            DB::commit();
            return $message = 'you are following ' . $this->title;
            } catch (\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
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
        $this->followers()->where([
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
