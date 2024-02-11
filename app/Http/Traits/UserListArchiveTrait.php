<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\UserList;
use App\Models\UserListArchive;


trait UserListArchiveTrait {

    public function userLestArchives()
    {
        return $this->morphMany(UserListArchive::class, 'saveable');
    }

    public function saveToList(UserList $userList) {
        if ($this->isSavedInListByUser($userList)) {
            $this->removeItemFromList($userList);
            $message = get_class($this) . '  removed successfully';
        } else {
            $this->addItemToList($userList);
            $message = get_class($this) . ' add to list successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function isSavedInListByUser(UserList $userList): bool
    {
        return $this->userLestArchives()
                    ->where('saveable_id',$this->id)
                    ->where('saveable_type',get_class($this))
                    ->where('user_list_id',$userList->id)
                    ->exists();
    }

    private function addItemToList(UserList $userList)
    {
        $existing = $this->userLestArchives()->where([
            'saveable_id'   => $this->id,
            'saveable_type' => get_class($this),
            'user_list_id' => $userList->id,
            ])->first();

            if (!$existing) {
                $this->userLestArchives()->create([
                'saveable_id' => $this->id,
                'saveable_type' => get_class($this),
                'user_list_id' => $userList->id,
            ]);
        }
    }

    private function removeItemFromList(UserList $userList)
    {
        $this->userLestArchives()->where([
            'saveable_id' => $this->id,
            'saveable_type' => get_class($this),
            'user_list_id' => $userList->id,
        ])->delete();
    }

}
