<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\UserList;
use App\Models\UserListArchive;


trait UserListArchiveTrait {

    public function archives(){
        return $this->morphMany(UserListArchive::class,'saveable');
    }

    public function saveToList(User $user,UserList $userList) {
        if ($this->isSavedInListByUser($user)) {
            $this->removeItemFromList($user);
            $message = get_class($this) . '  removed successfully';
        } else {
            $this->addItemToList($user);
            $message = get_class($this) . ' add to list successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function isSavedInListByUser(User $user,UserList $userList): bool
    {
        return $this->archives()->where('user_id', $user->id)
                    ->where('saveable_id',$this->id)
                    ->where('saveable_type',get_class($this))
                    ->where('user_list_id',$userList->id)
                    ->exists();
    }

    private function addItemToList(User $user)
    {
        $existing = $this->archives()->where([
            'user_id'      => $user->id,
            'saveable_id'   => $this->id,
            'saveable_type' => get_class($this),
            'user_list_id' => $userList->id,
        ])->first();

        if (!$existing) {
            $user->archives()->create([
                'saveable_id' => $this->id,
                'saveable_type' => get_class($this),
                'user_list_id' => $userList->id,
            ]);
        }
    }

    private function removeItemFromList(User $user,UserList $userList)
    {
        $this->archives()->where([
            'user_id' => $user->id,
            'saveable_id' => $this->id,
            'saveable_type' => get_class($this),
            'user_list_id' => $userList->id,
        ])->delete();
    }

}
