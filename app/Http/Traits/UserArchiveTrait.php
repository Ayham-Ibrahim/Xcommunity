<?php
namespace App\Http\Traits;

use App\Models\Archive;
use App\Models\User;


trait UserArchiveTrait {

    public function archives(){
        return $this->morphMany(Archive::class,'saveable');
    }

    public function saveToArchive(User $user) {
        if ($this->isSavedInArchiveByUser($user)) {
            $this->removeItemFromArchive($user);
            $message = $this->title .' unsaved successfully';
        } else {
            $this->addItemToArchive($user);
            $message = $this->title .' saved successfully';
        }

        return response()->json(['message' => $message]);
    }

    public function isSavedInArchiveByUser(User $user,): bool
    {
        return $this->archives()->where('user_id', $user->id)
                    ->where('saveable_id',$this->id)
                    ->where('saveable_type',get_class($this))
                    ->exists();
    }

    private function addItemToArchive(User $user)
    {
        $existing = $this->archives()->where([
            'user_id'      => $user->id,
            'saveable_id'   => $this->id,
            'saveable_type' => get_class($this),
        ])->first();

        if (!$existing) {
            $this->archives()->create([
                'user_id'      => $user->id,
                'saveable_id' => $this->id,
                'saveable_type' => get_class($this),
            ]);
        }
    }

    private function removeItemFromArchive(User $user)
    {
        $this->archives()->where([
            'user_id' => $user->id,
            'saveable_id' => $this->id,
            'saveable_type' => get_class($this),
        ])->delete();
    }

}
