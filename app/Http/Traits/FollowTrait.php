<?php
namespace App\Http\Traits;

use App\Models\User;

trait FollowTrait
{
    public function followToggle (User $user){
        if ($this->hasFollowedByUser($user)){
            $this->unFollow($user);
            $message = 'you are following ' . get_class($this);
        }else {
            $this->follow($user);
            $message = 'you are Unfollowing ' . get_class($this);
        }
    }

    public function hasFollowedByUser(User $user){
        return $this->followers()->where('user_id', $user->id)
                    ->where('followable_id',$this->id)
                    ->where('followable_type',get_class($this))
                    ->exists();
    }

    public function follow(User $user){

        $existingLike = $this->followers()->where([
            'user_id'      => $user->id,
            'followable_id'     => $this->id,
            'followable_type'   => get_class($this),
        ])->first();

        // If the user hasn't liked the blog, create a new like
        if (!$existingLike) {
            $user->followers()->create([
                'followable_id'     => $this->id,
                'followable_type'   => get_class($this),
            ]);
        }

    }


    public function unFollow(User $user){
        $user->followers()->where([
            'user_id' => $user->id,
            'followable_id'     => $this->id,
            'followable_type'   => get_class($this),
        ])->delete();
    }

    public function followersCount(){
        return $this->followers->count();
    }
}
