<?php

namespace App\Http\Traits;

use App\Models\User;

trait DownloadFileTrait {


    public function downloadFile(User $user,$file,$folder)
    {
        if($this->hasDownloadByUser($user)){
            $user->downloads()->create([
                'followable_id'     => $this->id,
                'followable_type'   => get_class($this),
            ]);
            $path = storage_path(asset("files/{$folder}/{$file}"));
            if (file_exists($path)) {
                return response()->download($path);
            } else {
                return response()->json(['message' => 'Not Found!'], 404);
            }
        }
    }

    public function hasDownloadByUser(User $user){
        return $this->downloads()->where('user_id', $user->id)
                    ->where('downloadable_id',$this->id)
                    ->where('downloadable_type',get_class($this))
                    ->exists();
    }

    public function downloadsCount(){
        return $this->downloads->count();
    }
}
